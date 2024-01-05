<?php
function get_course()
{
    include '../Controller/Data.php';
    return array_values($course);
}
/** 
 * @param string $semester key the course 
 * @return string
*/
function find_by_semester($semester){
    include '../Controller/Data.php';
    return (array_key_exists($semester, $course))?$course[$semester] : "không có tên khóa học";
}
?>