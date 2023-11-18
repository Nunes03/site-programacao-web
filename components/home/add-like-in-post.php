<?php
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Database/Entities/PostEntity.php");
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Database/Repositories/PostRepository.php");

addLikeByPostId();

echo "{}";

function addLikeByPostId() {
    $postId = $_POST["postId"];

    $postRepository = new PostRepository();
    $postRepository->addLikesById($postId);
}
