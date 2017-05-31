SELECT
t.name1, t.name1, t.name3, t.id,t.quantity, count(t.student_id) as kol
FROM
(select s.name as name1, g.name name2, a.name name3,ck.id,ck.quantity,cr.student_id
from control c
Inner JOIN control_attestation ca ON c.id=ca.control_id
inner join `subject` s on c.subject_id = s.id
INNER JOIN `group` g ON c.group_id = g.id
INNER JOIN attestation a ON ca.attestation_id = a.id
INNER JOIN checkout ck on ca.id=ck.control_attestation_id
LEFT JOIN checkout_result cr ON ck.id=cr.checkout_id
) t
GROUP BY t.name1, t.name1, t.name3, t.id,t.quantity



select a.name name3,ck.id,cw.id,ck.quantity,count(cwc.id)
from control c
Inner JOIN control_attestation ca ON c.id=ca.control_id
INNER JOIN attestation a ON ca.attestation_id = a.id
INNER JOIN checkout ck on ca.id=ck.control_attestation_id
INNER JOIN checkout_work cw ON ck.id=cw.checkout_id
INNER JOIN checkout_work_competence cwc ON cw.id=cwc.checkout_work_id
LEFT JOIN checkout_competence_result ccr on cw.id = ccr.checkout_work_id

group by  a.name,ck.id,cw.id,ck.quantity