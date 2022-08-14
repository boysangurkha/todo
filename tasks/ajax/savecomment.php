<?php
$dir = dirname(__DIR__, 2);

include_once("$dir/classes/Comment.php");

    if(!empty($_POST)){
        $c = new Comment();
        $c->setTaskId($_POST['taskId']);
        $c->setComment($_POST['comment']);

        $c->save();
        $response = [
            'status' => 'succes',
            'comment' => htmlspecialchars($c->getComment()),
            'message' => 'Comment saved'
        ];

        header('content-type:application/json');
        echo json_encode($response);
    }
?>