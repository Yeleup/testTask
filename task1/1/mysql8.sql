WITH RECURSIVE cte as (
  SELECT     d.id,
             d.parent_id,
             d.name,
             d.lft,
             d.rgt,
             CAST('' AS CHAR(1000)) AS title,
             d.name AS department_path,
             0 AS `level`
  from       departments d
  WHERE d.parent_id IS NULL 
  union all
  select     d.id,
             d.parent_id,
             d.name,
             d.lft,
             d.rgt,
             CONCAT('-', cte.title),
	          CONCAT(cte.department_path, '/', d.name),
             cte.`level` + 1
  from       departments d
  inner JOIN cte on d.parent_id = cte.id
)
SELECT id, `parent_id`, `lft`, `rgt`, if(`title` = '', cte.`name`, CONCAT(`title`, cte.`name`)) AS title, department_path,`level` from cte ORDER BY lft