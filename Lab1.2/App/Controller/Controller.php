<?php
include '../Model/Model.php';
$list_of_course=get_course();
$semester =(!empty($_GET['semester'])?$_GET['semester']:'');
$course_name = find_by_semester($semester);
$page_name=$course_name;
include '../Views/view.php'
?>