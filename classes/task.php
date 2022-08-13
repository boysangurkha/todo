<?php
    include_once(__DIR__ . "/db.php");

    class Task { 
        private $title;
        private $listId;
        private $deadline;
        private $hours;
        private $userId;

        public function getTitle()
        {
                return $this->title;
        }

        public function setTitle($title)
        {
            if(empty($title)){
                throw new Exception("Title cannot be empty.");
            }
            $this->title = $title;

            return $this;
        }


        public function getListId()
        {
                return $this->listId;
        }

        public function setListId($listId)
        {
            $this->listId = $listId;

            return $this;
        }


        public static function getById($id)
        {
            $conn = Db::getInstance();
            $stmt = $conn->prepare("SELECT * FROM tasks WHERE id = :id");
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            $result = $stmt->fetch();
            return $result;
        }

        public static function getByListId($listId)
        {
            $conn = Db::getInstance();
            $stmt = $conn->prepare("SELECT * FROM tasks WHERE list_id = :list_id");
            $stmt->bindValue(":list_id", $listId);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        }

        public function save()
        {
            $conn = Db::getInstance();
            $stmt = $conn->prepare("INSERT INTO tasks (title, hours, deadline, list_id, user_id) VALUES (:title, :hours, :deadline, :list_id, :user_id)");
            $stmt->bindValue(":title", $this->title);
            $stmt->bindValue(":hours", $this->hours);
            $stmt->bindValue(":deadline", $this->deadline);
            $stmt->bindValue(":list_id", $this->listId);
            $stmt->bindValue(":user_id", $this->userId);
            $stmt->execute();
        }

        public static function deleteById($id)
        {
            $conn = Db::getInstance();
            $stmt = $conn->prepare("DELETE FROM tasks WHERE id = :id");
            $stmt->bindValue(":id", $id);
            $stmt->execute();
        }


        public function getDeadline()
        {
                return $this->deadline;
        }

        public function setDeadline($deadline)
        {
                if(empty($deadline)){
                    throw new Exception("deadline cannot be empty.");
                }
                $this->deadline = $deadline;

                return $this;
                
        }

        public function getHours()
        {
                return $this->hours;
        }

        public function setHours($hours)
        {
                if(empty($hours)){
                    throw new Exception("hours cannot be empty.");
                }
                $this->hours = $hours;

                return $this;
        }

        public function getUserId()
        {
                return $this->userId;
        }

        public function setUserId($userId)
        {
                $this->userId = $userId;

                return $this;
        }
    }