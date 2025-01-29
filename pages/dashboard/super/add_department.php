<?php
include('nav/header.php');

?>
<!-- end topbar -->
<!-- dashboard inner -->
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Add Department</h2>
                </div>
            </div>
        </div>
        <div class="full_container">
            <div class="container">
                <div class="center">
                    <div class="login_section">
                        <div class="logo_login">
                            <div class="center">
                                <img width="210" src="images/logo/vitalcare-medical-center-high-resolution-logo-transparent (1).png" alt="#" />
                            </div>
                        </div>
                        <div class="login_form">
                            <form method="POST" action="config/add_department.php">
                                <fieldset>
                                    <div class="field">
                                        <label class="label_field">Department_Name</label>
                                        <input type="text" name="DepartmentName" placeholder="Department Name" required />
                                    </div>
                                    <div class="field">
                                        <label class="label_field">Description</label>
                                        <textarea name="Description" placeholder="Enter Description...." required id="textarea"></textarea>
                                    </div>
                                    <div class="field margin_0">
                                        <label class="label_field hidden">hidden label</label>
                                        <button type="submit" class="main_bt">Submit</button>
                                    </div>
                                </fieldset>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- footer -->
<?php
include('nav/footer.php');

?>



<!-- 
Emergency Department (ED): This is where patients with urgent medical conditions are treated. It's often the first point of contact for patients seeking immediate medical attention.

Intensive Care Unit (ICU): This is a specialized department that provides critical care to patients with life-threatening conditions. It's equipped with advanced monitoring equipment and staffed by specialized healthcare professionals.

Operating Theatre: This is where surgical procedures are performed. It's a sterile environment with specialized equipment for various types of surgeries.

Inpatient Wards: These are areas where patients stay for one or more nights. They are typically divided into specialized units based on the type of care required, such as medical, surgical, pediatric, or geriatric.

Outpatient Department (OPD): This is where patients receive medical care without being admitted to the hospital. It includes various clinics such as general medicine, surgery, pediatrics, gynecology, and others.

Diagnostic Services: These include departments like radiology, pathology, and medical imaging. They provide services for diagnosing various medical conditions.

Rehabilitation Services: These departments help patients recover from injuries or illnesses that have affected their physical or mental abilities. They include physical therapy, occupational therapy, and speech therapy.

Pharmacy: This is where medications are stored and dispensed. It's staffed by pharmacists who provide advice on the safe use of medications.

Laboratory Services: These departments conduct various tests to assist in the diagnosis and treatment of medical conditions. They include clinical biochemistry, hematology, microbiology, and histopathology.

Mental Health Services: These departments provide care for patients with mental health conditions. They include psychiatry, psychology, and social work services.

Blood Bank: This department is responsible for the collection, testing, and storage of blood and its components. It supplies blood products for transfusions to patients in the hospital.

Nutrition and Dietetics: This department provides advice on dietary matters to patients. They help in planning meals for patients with special dietary needs.

Medical Records: This department maintains all the medical records of the patients. They ensure the confidentiality and accuracy of the records.

Administration: This department oversees the management and operation of the hospital. It includes roles like hospital administration, human resources, finance, and public relations.

Medical Education and Research: Some hospitals have a department dedicated to medical education and research. They may be affiliated with a medical school or university and provide training to medical students, residents, and fellows. They may also conduct research to advance medical knowledge and practice. -->