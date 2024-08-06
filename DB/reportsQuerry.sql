
//Students details
SELECT CONCAT_WS(' ',s.S_Fname,s.S_Mname,s.S_Lname) as Name,c.Class_name as Class,d.Dept_name as Department,com.C_Name as Company,jp.J_Offered_salary as Offered_Salary,jo.Job_Post_Date as Joining_Date
FROM student as s
INNER JOIN class as c on s.S_Class_id=c.Class_id
INNER JOIN department as d on d.Dept_id=c.Dept_id
INNER JOIN jobapplication as ja ON ja.S_College_Email = s.S_College_Email 
INNER JOIN jobposting as jo ON jo.J_id = ja.J_id
INNER JOIN jobplacements as jp on jp.J_id = ja.J_id
INNER JOIN company as com on com.C_id = jo.C_id

WHERE ja.placed = 1;

//Placement Data
SELECT 
    ROW_NUMBER() OVER (ORDER BY s.S_Fname, s.S_Lname) AS 'Sr. No',
    CONCAT(s.S_Fname, ' ', s.S_Mname, ' ', s.S_Lname) AS 'Student Name', 
    c.C_Name AS 'Company Name', 
    c.C_Location AS 'Location', 
    jb.J_Offered_salary AS 'Salary Package in LPA (Lakhs per annum)'
FROM 
    student s
INNER JOIN 
    jobapplication j ON j.S_College_Email = s.S_College_Email
INNER JOIN 
    jobposting jp ON jp.J_id = j.J_id
INNER JOIN 
    company c ON c.C_id = jp.C_id
INNER JOIN 
    jobplacements jb ON jb.J_id = j.J_id
INNER JOIN 
    class CL ON cl.Class_id = s.S_Class_id
INNER JOIN 
    department D ON d.Dept_id = cl.Dept_id
WHERE d.Dept_name = 'COMP'; // php ?