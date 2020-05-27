TYPE=VIEW
query=select `rodo`.`grades`.`id` AS `id`,`rodo`.`grades`.`student_id` AS `student_id`,`rodo`.`students`.`number` AS `student_number`,`rodo`.`teachers`.`id` AS `teacher_id`,`rodo`.`teachers`.`display_name` AS `teacher_name`,`rodo`.`grades`.`value` AS `value`,`rodo`.`grades`.`task` AS `task`,`rodo`.`grades`.`comment` AS `comment`,`rodo`.`grades`.`date` AS `date`,`rodo`.`grades`.`expire_date` AS `expire_date` from `rodo`.`grades` join `rodo`.`teachers` join `rodo`.`students` where `rodo`.`grades`.`teacher_id` = `rodo`.`teachers`.`id` and `rodo`.`grades`.`student_id` = `rodo`.`students`.`id`
md5=1d7ea428ae59f48f01e3f2d4f2c8ad2e
updatable=1
algorithm=0
definer_user=root
definer_host=localhost
suid=1
with_check_option=0
timestamp=2020-05-27 12:40:24
create-version=2
source=SELECT\n    `rodo`.`grades`.`id` AS `id`,\n    `rodo`.`grades`.`student_id` AS `student_id`,\n    `rodo`.`students`.`number` AS `student_number`,\n    `rodo`.`teachers`.`id` AS `teacher_id`,\n    `rodo`.`teachers`.`display_name` AS `teacher_name`,\n    `rodo`.`grades`.`value` AS `value`,\n    `rodo`.`grades`.`task` AS `task`,\n    `rodo`.`grades`.`comment` AS `comment`,\n    `rodo`.`grades`.`date` AS `date`,\n    `rodo`.`grades`.`expire_date` AS `expire_date`\nFROM\n    `rodo`.`grades`,\n 	`rodo`.`teachers`,\n    `rodo`.`students`\nWHERE\n    `rodo`.`grades`.`teacher_id` = `rodo`.`teachers`.`id` and\n    `rodo`.`grades`.`student_id` = `rodo`.`students`.`id`
client_cs_name=utf8mb4
connection_cl_name=utf8mb4_unicode_ci
view_body_utf8=select `rodo`.`grades`.`id` AS `id`,`rodo`.`grades`.`student_id` AS `student_id`,`rodo`.`students`.`number` AS `student_number`,`rodo`.`teachers`.`id` AS `teacher_id`,`rodo`.`teachers`.`display_name` AS `teacher_name`,`rodo`.`grades`.`value` AS `value`,`rodo`.`grades`.`task` AS `task`,`rodo`.`grades`.`comment` AS `comment`,`rodo`.`grades`.`date` AS `date`,`rodo`.`grades`.`expire_date` AS `expire_date` from `rodo`.`grades` join `rodo`.`teachers` join `rodo`.`students` where `rodo`.`grades`.`teacher_id` = `rodo`.`teachers`.`id` and `rodo`.`grades`.`student_id` = `rodo`.`students`.`id`
mariadb-version=100411
