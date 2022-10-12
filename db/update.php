<?php 

  class update {
    private $db;
    
    function __construct($conn) {
      $this->db = $conn;
    }

    public function edit($id, $co_name, $post_title, $post_description, $co_website) {
      try { 
        $sql = "UPDATE `internships` SET `co_name`=:co_name, `post_title`=:post_title, `post_description`=:post_description, `co_website`=:co_website WHERE `id` = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindparam(':id', $id);
        $stmt->bindparam(':co_name', $co_name);
        $stmt->bindparam(':post_title', $post_title);
        $stmt->bindparam(':post_description', $post_description);
        $stmt->bindparam(':co_website', $co_website);
        $stmt->execute();
        return true;

      } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
      }  
    }
    
    public function archive_internship($id) {
      try {
        $sql = "UPDATE `internships` SET `status` = 'archived' WHERE `id` = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindparam(':id', $id);
        $stmt->execute();
        return true;

      } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
      }
    }

    public function unarchive_internship($id) {
      try {
        // HERE IS AN ERROR! THIS WILL ALLOW COMPANIES TO PUBLISH EVEN THO THEY ARE IN THE REVIEWED PROCESS!
        $sql = "UPDATE `internships` SET `status` = 'published' WHERE `id` = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindparam(':id', $id);
        $stmt->execute();
        return true;

      } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
      }
    }

    public function publish_internship($id) {
      try {
        // HERE IS AN ERROR! THIS WILL ALLOW COMPANIES TO PUBLISH EVEN THO THEY ARE IN THE REVIEWED PROCESS!
        $sql = "UPDATE `internships` SET `status` = 'published' WHERE `id` = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindparam(':id', $id);
        $stmt->execute();
        return true;

      } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
      }
    }

    public function decline_internship($id) {
      try {
        // HERE IS AN ERROR! THIS WILL ALLOW COMPANIES TO PUBLISH EVEN THO THEY ARE IN THE REVIEWED PROCESS!
        $sql = "UPDATE `internships` SET `status` = 'declined' WHERE `id` = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindparam(':id', $id);
        $stmt->execute();
        return true;

      } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
      }
    }

    public function edit_profile($short_about_me, $github_lenke, $mail_lenke, $linkedin_lenke, $about_me, $id) {
      try { 
        $sql = "UPDATE `about_me` SET `short_about_me`=:short_about_me, `github_lenke`=:github_lenke, `mail_lenke`=:mail_lenke, `linkedin_lenke`=:linkedin_lenke, `about_me`=:about_me WHERE `about_me`.`user_id` = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindparam(':short_about_me', $short_about_me);
        $stmt->bindparam(':github_lenke', $github_lenke);
        $stmt->bindparam(':mail_lenke', $mail_lenke);
        $stmt->bindparam(':linkedin_lenke', $linkedin_lenke);
        $stmt->bindparam(':about_me', $about_me);
        $stmt->bindparam(':id', $id);
        $stmt->execute();
        return true;

      } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
      }  
    }

    public function set_student_status_to_accepted_for_internship($user_id, $internship_id) {
      try { 
        $sql = "UPDATE `student_has_internship` SET `status`= 'accepted' WHERE `user_id` = :user_id AND internship_id = :internship_id AND `status` = 'pending'";
        $stmt = $this->db->prepare($sql);
        $stmt->bindparam(':user_id', $user_id);
        $stmt->bindparam(':internship_id', $internship_id);
        $stmt->execute();
        return true;

      } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
      }  
    }

    public function set_student_status_to_denied_for_internship($user_id, $internship_id) {
      try { 
        // SQL BELOW MIGHT GIVE ERROR BECAUSE OF 'OR' AT THE END!
        $sql = "UPDATE `student_has_internship` SET `status`= 'denied' WHERE `user_id` = :user_id AND internship_id = :internship_id AND `status` = 'pending' OR `status` = 'accepted'";
        $stmt = $this->db->prepare($sql);
        $stmt->bindparam(':user_id', $user_id);
        $stmt->bindparam(':internship_id', $internship_id);
        $stmt->execute();
        return true;

      } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
      }  
    }

    
  }
?>