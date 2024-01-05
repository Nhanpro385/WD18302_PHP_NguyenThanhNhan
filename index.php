<?php
echo ('PC06839 -Lab1.1 <br>');
$course = [
    's1' => 'Lập trình php',
    's2' => 'Redis MQ',
    's3' => 'MongoDB'
];
echo $course['s2'];
echo '<br>';
//model
/**
 *  @return array
 */
function get_course()
{
    global $course;
    return array_values($course);
}
/** 
 * @param string $semester key the course 
 * @return string
*/
function find_by_semester($semester){
    global $course;
    return (array_key_exists($semester, $course))?$course[$semester] : "không có tên khóa học";
}
//controller
$list_of_course=get_course();
$semester =(!empty($_GET['semester'])?$_GET['semester']:'');
$course_name = find_by_semester($semester);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab 1.1 </title>
</head>
<body>
    <?php echo '<h1> '.$course_name.'</h1>' ?>
    <form action="" method="get">
        <select name="semester" id="">

        <?php foreach($course as $key => $value):?>
        <option value="<?= $key?>"><?= $value ?></option>
        <?php endforeach; ?>
        </select>
        <button type="submit">Tìm khóa học</button>
    </form>
</body>
</html>