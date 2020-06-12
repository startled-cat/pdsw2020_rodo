set global event_scheduler = ON;

create event AutoDeleteExpiredGrades
on schedule 
every 24 hour 
starts timestamp(CURRENT_DATE)
ends timestamp(CURRENT_DATE) + interval 10 minute
do 
delete from rodo.grades where expire_date < CURRENT_DATE;

create event AutoDeleteExpiredStudentAccounts
on schedule
every 24 hour
starts timestamp(CURRENT_DATE)
ends timestamp(CURRENT_DATE) + interval 10 minute
do
delete from rodo.students where expire_date is not null and expire_date < CURRENT_DATE;