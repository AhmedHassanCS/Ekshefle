<?php
$contracts_query="SELECT d.doc_fname, d.doc_sname ,d.doc_lname, d.doc_email, c.cont_code, c.exp_date, c.start_date, c.med_type
			  		FROM doctor as d, contract as c
              		where d.doc_id=c.doc_id
              		and c.is_expired=0";

              		$contracts=$db->query($contracts_query);

$doctors_query= "SELECT d.doc_fname, d.doc_sname ,d.doc_lname, d.doc_email, d.doc_phone ,d.doc_address ,s.spec_name
					FROM doctor as d, speciality as s 
					where d.spec_id=s.spec_id";

					$doctors=$db->query($doctors_query);

$clinics_query="SELECT m.med_id, m.med_name, ph.phone, addr.detailed_add, d.doc_email, d.doc_fname, d.doc_sname ,d.doc_lname ,m.is_active
				from medical as m, doctor as d, phone as ph, address as addr
				where m.med_type='Clinic'
				and m.med_id=ph.med_id
				and m.med_id=addr.med_id
				and d.doc_id=m.doc_id";

				$clinics=$db->query($clinics_query);

$hospital_query="SELECT m.med_id, m.med_name, ph.phone, addr.detailed_add, d.doc_email, d.doc_fname, d.doc_sname ,d.doc_lname ,m.is_active
				from medical as m, doctor as d, phone as ph, address as addr
				where m.med_type='Hospital'
				and m.med_id=ph.med_id
				and m.med_id=addr.med_id
				and d.doc_id=m.doc_id";
				
				$hospitals=$db->query($hospital_query);

$lap_query="SELECT m.med_id, m.med_name, ph.phone, addr.detailed_add, d.doc_email, d.doc_fname, d.doc_sname ,d.doc_lname,m.is_active
				from medical as m, doctor as d, phone as ph, address as addr
				where  m.med_id=ph.med_id
				and m.med_id=addr.med_id
				and d.doc_id=m.doc_id";
				
				$laps=$db->query($lap_query);

$confirmed_query="SELECT p.nat_id, p.pat_name, d.doc_email, d.doc_fname, d.doc_sname ,d.doc_lname, m.med_id,m.med_type, app.real_date
					from patient as p, doctor as d, medical as m, appointment as app
					where app.confirmed=1
					and p.nat_id=app.pat_id
					and m.med_id=app.med_id
					and d.doc_id=m.doc_id";

					$confirmed=$db->query($confirmed_query);

$pateints_query="SELECT * from patient";

				$patients=$db->query($pateints_query);

?>