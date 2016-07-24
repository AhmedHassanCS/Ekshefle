<?php

$reqs_query = "SELECT d.doc_email, d.doc_fname, d.doc_sname ,d.doc_lname , r.med_type, d.doc_phone, d.doc_address
				FROM doctor as d, request as r 
				WHERE r.doc_id=d.doc_id";

              $requests = $db->query($reqs_query);
              $requests_num = $requests->num_rows;

$apps_query= "SELECT p.nat_id, p.pat_name ,m.med_id ,m.med_name, m.med_type, app.time_date,phn.phone, d.doc_email, d.doc_fname, d.doc_sname ,d.doc_lname ,s.spec_name
				FROM patient as p, medical as m, appointment as app, phone as phn, doctor as d, med_spec as ms, speciality as s
				WHERE app.confirmed=0
				AND app.pat_id = p.nat_id
				AND app.med_id = m.med_id
				AND m.doc_id = d.doc_id
				AND m.med_id=ms.med_id
				AND phn.med_id=m.med_id
				AND ms.spec_id=s.spec_id";

				$appointments = $db->query($apps_query);
				$appointments_num = $appointments->num_rows;

$exp_query= "SELECT d.doc_fname, d.doc_sname ,d.doc_lname, d.doc_email, d.doc_phone, d.doc_address, c.cont_code, c.exp_date, c.med_type
			  FROM doctor as d, contract as c
              where d.doc_id=c.doc_id
              and c.is_expired=1";

              $expirations= $db->query($exp_query);
              $expirations_num=  $expirations->num_rows;

?>