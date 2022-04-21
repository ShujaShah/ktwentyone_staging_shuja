<?php
/*contact form auto responders*/
#hook in to wpcf7_mail_sent - this will happen after form is submitted
add_action( 'wpcf7_mail_sent', 'contact_form_autoresponders' ); 

#our autoresponders function
function contact_form_autoresponders( $contact_form ) {
    // The contact form ID.
    if ( 3874 === $contact_form->id ) {
        $submission  = WPCF7_Submission::get_instance();
        $posted_data = $submission->get_posted_data();
				$text= ', <br><br>Thank you for your inquiry regarding our Training Program.<br> Our expert team has received your query and will get back to you soon with the details you requested. <br><br> In addition to those details, we would like you to check out this absolutely FREE Class that will help you to get more insights into the technology, recent job trends, proven roadmap strategy to follow, and a lot more.<br><br>You can book yourself a free seat here: ';
        // Dropdowns are stored as arrays.
        if ( isset( $posted_data['menu-29'] ) ) {
            switch ( $posted_data['menu-29'][0] ) {
                case "OCI":
                    $msg = $text.' <link><a href="https://k21academy.com/1z01072-oci-architect-associate-free-masterclass/?utm_source=email&utm_medium=automation&utm_campaign=contact_inquiry_form">k21academy.com/oci02</a> . Meanwhile, our team has started working on your query and will get back to you soon.<br><br><a href="https://k21academy.com/1z01072-oci-architect-associate-free-masterclass/?utm_source=email&utm_medium=automation&utm_campaign=contact_inquiry_form"> <img src="https://k21academy.com/wp-content/uploads/2020/06/1Z0-1072ContnetUpgrade.gif" width="700" height="100"></a> <br><br> ';
                    break;
				case "OCI Architect Professional":
					$msg = ', Our expert team has received your query and will get back to you soon with the details you requested.';
					break;
				case "DBA To Cloud DBA":
					$msg =  $text.' <a href="https://k21academy.com/dba-to-cloud-dba-free-class/?utm_source=email&utm_medium=automation&utm_campaign=contact_inquiry_form">k21academy.com/clouddba02</a> . Meanwhile, our team has started working on your query and will get back to you soon.<br><br><a href="https://k21academy.com/1z01072-oci-architect-associate-free-masterclass/?utm_source=email&utm_medium=automation&utm_campaign=contact_inquiry_form"> <img src="https://k21academy.com/wp-content/uploads/2022/03/CloudDBA_CU.gif" width="700" height="100">';
					break;	
				case"EBS on OCI":
					$msg=', Our expert team has received your query and will get back to you soon with the details you requested.
Meanwhile, you can check out this FREE Class <a href="https://k21academy.com/ebs-on-oci-free-class/?utm_source=email&utm_medium=automation&utm_campaign=contact_inquiry_form">k21academy.com/ebscloud02</a>';
					break;
				case "OIC":
                    $msg = $text.' <a href="https://k21academy.com/oracle-integration-cloud-services-free-class/?utm_source=email&utm_medium=automation&utm_campaign=contact_inquiry_form"> k21academy.com/oic02</a> . Meanwhile, our team has started working on your query and will get back to you soon.<br><br><a href="https://k21academy.com/oracle-integration-cloud-services-free-class/?utm_source=email&utm_medium=automation&utm_campaign=contact_inquiry_form"> <img src="https://k21academy.com/wp-content/uploads/2021/08/CU_OIC_1042_GIF.gif" width="700" height="100"></a> <br><br> ';
                    break;

            }
        }
		       if ( isset( $posted_data['menu-334'] ) ) {
            switch ( $posted_data['menu-334'][0] ) {
                case "Azure Administrator":
                    $msg = $text.' <a href="https://k21academy.com/free-class-azure-admin-az-104-certification/?utm_source=email&utm_medium=automation&utm_campaign=contact_inquiry_form"> k21academy.com/az10402 </a> . Meanwhile, our team has started working on your query and will get back to you soon.<br><br><a href="https://k21academy.com/free-class-azure-admin-az-104-certification/?utm_source=email&utm_medium=automation&utm_campaign=contact_inquiry_form"> <img src="https://k21academy.com/wp-content/uploads/2022/02/AZ104_Demo_CUGif-1.gif" width="700" height="100"></a> <br><br> ';
                    break;
				case "Azure Devops":
					$msg = $text.' <a href="https://k21academy.com/az-400-microsoft-azure-devops-free-masterclass/?utm_source=email&utm_medium=automation&utm_campaign=contact_inquiry_form"> k21academy.com/az40002</a> . Meanwhile, our team has started working on your query and will get back to you soon.<br><br> <a href="https://k21academy.com/az-400-microsoft-azure-devops-free-masterclass/?utm_source=email&utm_medium=automation&utm_campaign=contact_inquiry_form"> <img src="https://k21academy.com/wp-content/uploads/2020/10/AZ-400_CU.gif" width="700" height="100"></a>  <br><br> ';
					break;
				case "Azure Solutions Architect":
					$msg = $text.' <a href="https://k21academy.com/azure-solution-architect-az305-certification-free-class/?utm_source=email&utm_medium=automation&utm_campaign=contact_inquiry_form"> k21academy.com/az30502 </a> .  Meanwhile, our team has started working on your query and will get back to you soon.<br><br> <a href="https://k21academy.com/azure-solution-architect-az305-certification-free-class/?utm_source=email&utm_medium=automation&utm_campaign=contact_inquiry_form"> <img src="https://k21academy.com/wp-content/uploads/2021/10/cu_fc_az305_gif-1.gif" width="700" height="100"></a>  <br><br> ';
					break;	
				case "Data Science":
					$msg= $text.' <a href="https://k21academy.com/microsoft-azure-data-scientist-certification-dp100-free-class/?utm_source=email&utm_medium=automation&utm_campaign=contact_inquiry_form"> k21academy.com/dp10002 </a> .  Meanwhile, our team has started working on your query and will get back to you soon.<br><br> <a href="https://k21academy.com/microsoft-azure-data-scientist-certification-dp100-free-class/?utm_source=email&utm_medium=automation&utm_campaign=contact_inquiry_form"> <img src="https://k21academy.com/wp-content/uploads/2020/07/DP-100_CU-04.gif" width="700" height="100"></a> <br><br> ';
					break;
				case "Data Engineer":
                    $msg = $text.'<a href="https://k21academy.com/free-class-azure-data-engineer-certification/?utm_source=email&utm_medium=automation&utm_campaign=contact_inquiry_form"> k21academy.com/dp20302 </a> .  Meanwhile, our team has started working on your query and will get back to you soon.<br><br> <a href="https://k21academy.com/free-class-azure-data-engineer-certification/?utm_source=email&utm_medium=automation&utm_campaign=contact_inquiry_form"> <img src="https://k21academy.com/wp-content/uploads/2021/06/CU_DP203_GIF1.gif" width="700" height="100"></a> <br><br> ';
                    break;
            }

        }
			 if ( isset( $posted_data['menu-667'] ) ) {
            switch ( $posted_data['menu-667'][0] ) {
                case "Aws Solutions Architect":
                    $msg = $text.' <a href="https://k21academy.com/saac02-aws-solutions-architect-certification-free-class/?utm_source=email&utm_medium=automation&utm_campaign=contact_inquiry_form"> k21academy.com/awssa02 </a> . Meanwhile, our team has started working on your query and will get back to you soon.<br><br> <a href="https://k21academy.com/saac02-aws-solutions-architect-certification-free-class/?utm_source=email&utm_medium=automation&utm_campaign=contact_inquiry_form"> <img src="https://k21academy.com/wp-content/uploads/2020/07/AWS_CU-05-1.gif" width="700" height="100"></a> <br><br> ';
                    break;
				case "Aws Devops":
					$msg = $text.' <a href="https://k21academy.com/free-class-amazon-devops-certification-for-beginners/?utm_source=email&utm_medium=automation&utm_campaign=contact_inquiry_form"> k21academy.com/awsdevops02 </a> . Meanwhile, our team has started working on your query and will get back to you soon.<br><br> <a href="https://k21academy.com/free-class-amazon-devops-certification-for-beginners/?utm_source=email&utm_medium=automation&utm_campaign=contact_inquiry_form"> <img src="https://k21academy.com/wp-content/uploads/2020/09/AWS_DevOps_CU.gif" width="700" height="100"></a> <br><br> ';
					break;
				case "AWS MLS":
					$msg = ' Our expert team has received your query and will get back to you soon with the details you requested.';
					break;	
				case "AWS Developer Associate":
					$msg= $text.' <a href="https://k21academy.com/aws-certified-developer-associate-free-class/?utm_source=email&utm_medium=automation&utm_campaign=contact_inquiry_form"> k21academy.com/awsdev02 </a> . Meanwhile, our team has started working on your query and will get back to you soon.<br><br> <a href="https://k21academy.com/aws-certified-developer-associate-free-class/?utm_source=email&utm_medium=automation&utm_campaign=contact_inquiry_form"> <img src="https://k21academy.com/wp-content/uploads/2020/11/AwsDev_CUGIF-2.gif" width="700" height="100"></a> <br><br> ';
					break;
            }

        }
		 if ( isset( $posted_data['menu-763'] ) ) {
            switch ( $posted_data['menu-763'][0] ) {
                case "Kubernetes Administrator":
                    $msg = $text.' <a href="https://k21academy.com/containers-kubernetes-certification-free-class/?utm_source=email&utm_medium=automation&utm_campaign=contact_inquiry_form"> k21academy.com/cka02 </a> . Meanwhile, our team has started working on your query and will get back to you soon.<br><br> <a href="https://k21academy.com/containers-kubernetes-certification-free-class/?utm_source=email&utm_medium=automation&utm_campaign=contact_inquiry_form"> <img src="https://k21academy.com/wp-content/uploads/2022/02/CKA_CU.gif" width="700" height="100"></a> <br><br> ';
                    break;
				case "Kubernetes Application Developer":
					$msg = $text.' <a href="https://k21academy.com/containers-kubernetes-certification-free-class/?utm_source=email&utm_medium=automation&utm_campaign=contact_inquiry_form"> k21academy.com/k8s02 </a> . Meanwhile, our team has started working on your query and will get back to you soon.<br><br> <a href="https://k21academy.com/containers-kubernetes-certification-free-class/?utm_source=email&utm_medium=automation&utm_campaign=contact_inquiry_form"> <img src="https://k21academy.com/wp-content/uploads/2022/02/CKA_CU.gif" width="700" height="100"></a> <br><br> ';
					break;
				case "Kubernetes Administrator & Security":
					$msg = $text.' <a href="https://k21academy.com/kubernetes-security-specialist-certification-free-class/?utm_source=email&utm_medium=automation&utm_campaign=contact_inquiry_form"> k21academy.com/cks02 </a> . Meanwhile, our team has started working on your query and will get back to you soon.<br><br> <a href="https://k21academy.com/kubernetes-security-specialist-certification-free-class/?utm_source=email&utm_medium=automation&utm_campaign=contact_inquiry_form"> <img src="https://k21academy.com/wp-content/uploads/2020/09/CKACKS_CU_GIF.gif" width="700" height="100"></a> <br><br> ';
					break;	
            }

        }
		if ( isset( $posted_data['menu-583'] ) ) {
            switch ( $posted_data['menu-583'][0] ) {
                case "Google Cloud":
                    $msg = $text.' <a href="https://k21academy.com/google-cloud-professional-certification-free-class/?utm_source=email&utm_medium=automation&utm_campaign=contact_inquiry_form"> k21academy.com/gcp02 </a> . Meanwhile, our team has started working on your query and will get back to you soon.<br><br> <a href="https://k21academy.com/google-cloud-professional-certification-free-class/?utm_source=email&utm_medium=automation&utm_campaign=contact_inquiry_form"> <img src="https://k21academy.com/wp-content/uploads/2021/06/GCP_ConentUpgrade1.gif" width="700" height="100"></a> <br><br> ';
                    break;
            }

        }
		
			// mail it to them using wp_mail.
            wp_mail( $posted_data['infusionsoft-email'], 'Thank you for your inquiry regarding - ' .$posted_data['menu-583'][0] , 'Hi '.$posted_data['infusionsoft-first-name'] .$msg. ' <br> -- <br><b><i>Atul Kumar</i></b> <br> <b><i>Author & Cloud Expert</i></b>' );

    }

}