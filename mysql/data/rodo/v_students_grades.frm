TYPE=VIEW
query=select `rodo`.`grades`.`id` AS `id`,`rodo`.`grades`.`student_id` AS `student_id`,`rodo`.`students`.`number` AS `student_number`,`rodo`.`teachers`.`id` AS `teacher_id`,`rodo`.`teachers`.`display_name` AS `teacher_name`,`rodo`.`grades`.`value` AS `value`,`rodo`.`grades`.`task` AS `task`,`rodo`.`grades`.`comment` AS `comment`,`rodo`.`grades`.`date` AS `date`,`rodo`.`grades`.`expire_date` AS `expire_date`,`rodo`.`grades`.`seen` AS `seen` from ((`rodo`.`grades` join `rodo`.`teachers`) join `rodo`.`students`) where `rodo`.`grades`.`teacher_id` = `rodo`.`teachers`.`id` and `rodo`.`grades`.`student_id` = `rodo`.`students`.`id`
md5=cd0cc5304f190b4e9553f34784efaa24
updatable=1
algorithm=0
definer_user=root
definer_host=localhost
suid=1
with_check_option=0
timestamp=2020-06-12 14:16:50
create-version=2
source=SELECT\n    `rodo`.`grades`.`id` AS `id`,\n    `rodo`.`grades`.`student_id` AS `student_id`,\n    `rodo`.`students`.`number` AS `student_number`,\n    `rodo`.`teachers`.`id` AS `teacher_id`,\n    `rodo`.`teachers`.`display_name` AS `teacher_name`,\n    `rodo`.`grades`.`value` AS `value`,\n    `rodo`.`grades`.`task` AS `task`,\n    `rodo`.`grades`.`comment` AS `comment`,\n    `rodo`.`grades`.`date` AS `date`,\n    `rodo`.`grades`.`expire_date` AS `expire_date`,\n    `rodo`.`grades`.`seen` AS `seen`\nFROM\n    `rodo`.`grades`\nJOIN `rodo`.`teachers` JOIN `rodo`.`students` WHERE\n    `rodo`.`grades`.`teacher_id` = `rodo`.`teachers`.`id` AND `rodo`.`grades`.`student_id` = `rodo`.`students`.`id`
client_cs_name=utf8mb4
connection_cl_name=utf8mb4_unicode_ci
view_body_utf8=select `rodo`.`grades`.`id` AS `id`,`rodo`.`grades`.`student_id` AS `student_id`,`rodo`.`students`.`number` AS `student_number`,`rodo`.`teachers`.`id` AS `teacher_id`,`rodo`.`teachers`.`display_name` AS `teacher_name`,`rodo`.`grades`.`value` AS `value`,`rodo`.`grades`.`task` AS `task`,`rodo`.`grades`.`comment` AS `comment`,`rodo`.`grades`.`date` AS `date`,`rodo`.`grades`.`expire_date` AS `expire_date`,`rodo`.`grades`.`seen` AS `seen` from ((`rodo`.`grades` join `rodo`.`teachers`) join `rodo`.`students`) where `rodo`.`grades`.`teacher_id` = `rodo`.`teachers`.`id` and `rodo`.`grades`.`student_id` = `rodo`.`students`.`id`
mariadb-version=100411
