
## select students name does not match (exam , user tables)

SELECT e.user_id, e.user_name AS exam_name, u.name AS user_name
FROM exam e
LEFT JOIN users u ON e.user_id = u.center_code
WHERE e.user_name <> u.name;

## update students name does not match (exam , user tables)

UPDATE exam e
LEFT JOIN users u ON e.user_id = u.center_code
SET e.user_name = u.name
WHERE e.user_name <> u.name;


## update name to avoid pdf arabic error 

UPDATE exam 
SET column_name = REPLACE(column_name, N'الله', N'اللَّه')
WHERE column_name LIKE N'%الله%';

UPDATE  users
SET column_name = REPLACE(column_name, N'الله', N'اللَّه')
WHERE column_name LIKE N'%الله%';




php artisan make:migration login_log  --path=database/migrations/logs
php artisan make:migration register_log  --path=database/migrations/logs
php artisan make:migration admin_log  --path=database/migrations/logs
php artisan make:migration student_log  --path=database/migrations/logs
php artisan make:migration student_exam_log  --path=database/migrations/logs
php artisan make:migration parent_log  --path=database/migrations/logs