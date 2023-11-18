<?php
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Database/Entities/PostEntity.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Database/Repositories/UserRepository.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Database/Repositories/PostRepository.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/UserFile/UserFileManagement.php");

createPost();

function createPost()
{
    $postRepository = new PostRepository();

    $newPost = buildPost();
    $postRepository->create($newPost);
}

function buildPost()
{
    date_default_timezone_set("America/Sao_Paulo");

    $newPost = new PostEntity();
    $newPost->setContent($_POST["content"]);
    $newPost->setUser(findUserByEmail());
    $newPost->setDate(date('Y/m/d H:i'));
    $newPost->setLikes(0);

    if ($_POST["imageName"] != null || trim($_POST["imageName"]) != "") {
        $fileName = saveImage();
        $newPost->setFileName($fileName);
    }

    return $newPost;
}

/**
 * @return string
 */
function saveImage()
{
    $imageName = $_POST["imageName"];
    $imageContent = $_POST["imageContent"];
    $imageContent = explode(";", $imageContent)[1];
    $imageContent = str_replace("base64,", "", $imageContent);
    $imageContent = base64_decode($imageContent);

    return UserFileManagement::savePostFile(
        $_POST["userEmail"],
        $imageName,
        $imageContent
    );
}

function findUserByEmail()
{
    $userRepository = new UserRepository();
    return $userRepository->findByEmail($_POST["userEmail"]);
}

echo "{}";
