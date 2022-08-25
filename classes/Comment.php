<?php
    include_once("Db.php");

    class Comment {
        private $comment;
        private $taskId;

        public function getComment()
        {
                return $this->comment;
        }

        public function setComment($comment)
        {
                $this->comment = $comment;

                return $this;
        }

        public function getTaskId()
        {
                return $this->taskId;
        }

        public function setTaskId($taskId)
        {
                $this->taskId = $taskId;

                return $this;
        }

        public function save(){
            $conn = Db::getInstance();
            $stmt = $conn->prepare("INSERT INTO comments (comment, taskId) VALUES (:comment, :taskId)");

            $comment = $this->getComment();
            $taskId = $this->getTaskId();

            $stmt->bindValue(":comment", $comment);
            $stmt->bindValue(":taskId", $taskId);
            $result = $stmt->execute();
            return $result;
        }

        public static function getCommentsByTaskId($id){
                $conn = Db::getInstance();
                $stmt = $conn->prepare("select * from comments where taskId = :id");
                $stmt -> bindValue(":id", $id);
                $stmt -> execute();
                $comment = ($stmt->fetchAll(PDO::FETCH_ASSOC));
                return $comment;
        }

}