<?php

  class menu {

    private $element_id;

    private $title;

    private $link;

    private $parent_id;

    private $admin_id;

    private $parent_name;

    public function __construct() {
      db_connect();
    }

    public function __destruct() {
      db_close();
    }

    public function get_parent_id($element_id) {
      global $conn;
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      try {
        $return_id = $conn->prepare('SELECT parent_id FROM menu_items WHERE id=:id');
        $return_id->bindParam(':id', $element_id, PDO::PARAM_STR); //assuming it is a string
        $return_id->execute();
        $result = $return_id->fetchAll();
        $parent_id = ($result[0]['parent_id']);
        return $parent_id;
      } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
        return NULL;
      }
    }

    public function get_element_title($element_id) {
      global $conn;
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      try {
        $return_title = $conn->prepare('SELECT title FROM menu_items WHERE id=:id');
        $return_title->bindParam(':id', $element_id, PDO::PARAM_STR); //assuming it is a string
        $return_title->execute();
        $result = $return_id->fetchAll();
        $title = ($result[0]['title']);
        return $title;
      } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
        return NULL;
      }
    }

    public function get_menu_name($menu_id) {
      global $conn;
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      try {
        $return_name = $conn->prepare('SELECT parent FROM types WHERE type_id=:type_id');
        $return_name->bindParam(':type_id', $menu_id, PDO::PARAM_STR); //assuming it is a string
        $return_name->execute();
        $result = $return_name->fetchAll();
        $parent = ($result[0]['parent']);
        return $parent;
      } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
        return NULL;
      }
    }

    public function get_element_link($element_id) {
      global $conn;
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      try {
        $return_link = $conn->prepare('SELECT link FROM menu_items WHERE id=:id');
        $return_link->bindParam(':id', $element_id, PDO::PARAM_STR); //assuming it is a string
        $return_link->execute();
        $result = $return_id->fetchAll();
        $link = ($result[0]['link']);
        return $link;
      } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
        return NULL;
      }
    }

    public function get_parent_name($element_id) {
      global $conn;
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      try {
        $return_name = $conn->prepare('SELECT menu_items.parent_id, types.parent FROM menu_items,types 
        WHERE id=:id and menu_items.parent_id=types.type_id');
        $return_name->bindParam(':id', $element_id, PDO::PARAM_STR); //assuming it is a string
        $return_name->execute();
        $result = $return_name->fetchAll();
        $parent_name = ($result[0]['parent']);
        return $parent_name;
      } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
        return NULL;
      }
    }

    public function get_menus_types() {
      global $conn;
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      try {
        $return_menus = $conn->prepare('select count(menu_items.id) as elements, types.type_id,types.parent from menu_items,types 
        where menu_items.parent_id=types.type_id group by parent_id');
        $return_menus->execute();
        $result = $return_menus->fetchAll();
        return $result;
      } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
        return NULL;
      }
    }

    public function get_menu_items($menu_id) {
      global $conn;
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      try {
        $return_items = $conn->prepare("select id,title, link,class from menu_items 
        where parent_id=$menu_id");
        $return_items->execute();
        $result = $return_items->fetchAll();
        return $result;
      } catch (PDOException $e) {
        echo $e->getMessage();
        return NULL;
      }
    }

    public function add_element($menu_id) {
      try {
        db_connect();
        global $conn;
        //$parent = $_POST['menu-parent'];
        $title = $_POST['title'];
        $link = $_POST['link'];
        $admin_id = $_SESSION['id'];
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if ($menu_id == 5 || $menu_id == 8) {
          $class = $_POST['social-class'];
          $add_element = $conn->prepare("insert into menu_items(title,link,admin_id,parent_id,class)
        values('$title','$link',$admin_id,$menu_id,'$class')");
        }
        else {
          $add_element = $conn->prepare("insert into menu_items(title,link,admin_id,parent_id)
        values('$title','$link',$admin_id,$menu_id)");
        }
        $add_element->execute();
        return 1;
      } catch (PDOException $e) {
        echo $e->getMessage();
        return 0;
      }
    }

    public function update_menu($item_id) {
      global $conn;
      $title = $_POST['title'];
      $link = $_POST['link'];
      $admin_id = $_SESSION['id'];
      $menu_id = $_GET['id'];
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      try {
        if ($menu_id == 5 || $menu_id == 8) {
          $class = $_POST['social-class'];
          $sql = "update menu_items set title='$title' , link='$link' ,class='$class' ,admin_id=$admin_id 
          where id=$item_id";
        }
        else {
          $sql = "update menu_items set title='$title' , link='$link' ,admin_id=$admin_id 
          where id=$item_id";
        }
        $update_element = $conn->prepare($sql);
        $update_element->execute();
        return 1;
      } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
        return 0;
      }
    }

    public function delete_menu($item_id) {
      global $conn;
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      try {
        $sql = "delete from menu_items where id=$item_id";
        $update_element = $conn->prepare($sql);
        $update_element->execute();
        return 1;
      } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
        return 0;
      }
    }
  }