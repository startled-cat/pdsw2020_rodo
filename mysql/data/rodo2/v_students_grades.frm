TYPE=VIEW
query=select `rodo2`.`grades`.`id` AS `id`,`rodo2`.`grades`.`student_id` AS `student_id`,`rodo2`.`students`.`number` AS `student_number`,`rodo2`.`teachers`.`id` AS `teacher_id`,`rodo2`.`teachers`.`display_name` AS `teacher_name`,`rodo2`.`grades`.`value` AS `value`,`rodo2`.`grades`.`task` AS `task`,`rodo2`.`grades`.`comment` AS `comment`,`rodo2`.`grades`.`date` AS `date`,`rodo2`.`grades`.`expire_date` AS `expire_date`,`rodo2`.`grades`.`seen` AS `seen` from ((`rodo2`.`grades` join `rodo2`.`teachers`) join `rodo2`.`students`) where `rodo2`.`grades`.`teacher_id` = `rodo2`.`teachers`.`id` and `rodo2`.`grades`.`student_id` = `rodo2`.`students`.`id`
md5=3b3d39d5d99db6df29ddb9d5e7575a97
updatable=1
algorithm=0
definer_user=root
definer_host=localhost
suid=2
with_check_option=0
timestamp=2020-06-13 17:40:51
create-version=2
source=SELECT\n    `grades`.`id` AS `id`,\n    `grades`.`student_id` AS `student_id`,\n    `students`.`number` AS `student_number`,\n    `teachers`.`id` AS `teacher_id`,\n    `teachers`.`display_name` AS `teacher_name`,\n    `grades`.`value` AS `value`,\n    `grades`.`task` AS `task`,\n    `grades`.`comment` AS `comment`,\n    `grades`.`date` AS `date`,\n    `grades`.`expire_date` AS `expire_date`,\n    `grades`.`seen` AS `seen`\nFROM\n    (\n        (`grades`\n    JOIN `teachers`)\n    JOIN `students`\n    )\nWHERE\n    `grades`.`teacher_id` = `teachers`.`id` AND `grades`.`student_id` = `students`.`id`
client_cs_name=utf8mb4
connection_cl_name=utf8mb4_general_ci
view_body_utf8=select `rodo2`.`grades`.`id` AS `id`,`rodo2`.`grades`.`student_id` AS `student_id`,`rodo2`.`students`.`number` AS `student_number`,`rodo2`.`teachers`.`id` AS `teacher_id`,`rodo2`.`teachers`.`display_name` AS `teacher_name`,`rodo2`.`grades`.`value` AS `value`,`rodo2`.`grades`.`task` AS `task`,`rodo2`.`grades`.`comment` AS `comment`,`rodo2`.`grades`.`date` AS `date`,`rodo2`.`grades`.`expire_date` AS `expire_date`,`rodo2`.`grades`.`seen` AS `seen` from ((`rodo2`.`grades` join `rodo2`.`teachers`) join `rodo2`.`students`) where `rodo2`.`grades`.`teacher_id` = `rodo2`.`teachers`.`id` and `rodo2`.`grades`.`student_id` = `rodo2`.`students`.`id`
mariadb-version=100411
