<?php
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Database/Entities/PostEntity.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Database/Repositories/UserRepository.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Database/Repositories/PostRepository.php");

createPost();

function createPost() {
    $postRepository = new PostRepository();

    $newPost = buildPost();
    $postRepository->create($newPost);
}

function buildPost() {
    date_default_timezone_set("America/Sao_Paulo"); 

    $newPost = new PostEntity();
    $newPost->setContent($_POST["content"]);
    $newPost->setUser(findUserByEmail());
    $newPost->setDate(date('Y/m/d H:i'));
    $newPost->setLikes(0);

    if ($_POST["imageName"] != null || trim($_POST["imageName"]) != "") {
        $newPost->setFileName($_POST["imageName"]);
        saveImage();
    }

    return $newPost;
}

function saveImage() {
    $imageName = $_POST["imageName"];
    $photoBlob = addslashes($_FILES["imageContent"]["tmp_name"]);
    $photoBlob = file_get_contents($photoBlob);

    UserFileManagement::savePostFile(
        $_POST["userEmail"],
        $imageName,
        $photoBlob
    );
}

function findUserByEmail() {
    $userRepository = new UserRepository();
    return $userRepository->findByEmail($_POST["userEmail"]);
}

echo "{}";