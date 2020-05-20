<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH . 'libraries/REST_Controller.php');

/**
 *
 */
class Consultant extends REST_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model("mmodel");
		$this->load->model("mvalidation");
		$this->load->model("mlogin");
		$this->load->model("mdoctor");
		$this->load->model("mpublic");
		$this->load->model("mclinic");
		$this->load->model("mlocations");
		$this->load->model("mconsultantpool");
		$this->load->model("mclinicsession");
		$this->load->model("mclinicholidays");
		$this->load->model("mclinicsessionsubstituteconsultant");
		$this->load->model("motpcode");
		$this->load->model('appointmentserialnumber');
		$this->load->model('mserialnumber');
		$this->load->model('mclinicappointment');
		$this->load->model('mclinicsessiontrans');
	}

	//region Index
	public function index_get()
	{
		$response = new stdClass();
		$response->status = REST_Controller::HTTP_BAD_REQUEST;
		$response->msg = 'Invalid Request.';
		$response->error_msg = 'Invalid Request.';
		$response->response = NULL;
		$this->response($response, REST_Controller::HTTP_BAD_REQUEST);
	}

	public function index_post()
	{
		$response = new stdClass();
		$response->status = REST_Controller::HTTP_BAD_REQUEST;
		$response->msg = 'Invalid Request.';
		$response->error_msg = 'Invalid Request.';
		$response->response = NULL;
		$this->response($response, REST_Controller::HTTP_BAD_REQUEST);
	}

	public function index_put()
	{
		$response = new stdClass();
		$response->status = REST_Controller::HTTP_BAD_REQUEST;
		$response->msg = 'Invalid Request.';
		$response->error_msg = 'Invalid Request.';
		$response->response = NULL;
		$this->response($response, REST_Controller::HTTP_BAD_REQUEST);
	}

	public function index_delete()
	{
		$response = new stdClass();
		$response->status = REST_Controller::HTTP_BAD_REQUEST;
		$response->msg = 'Invalid Request.';
		$response->error_msg = 'Invalid Request.';
		$response->response = NULL;
		$this->response($response, REST_Controller::HTTP_BAD_REQUEST);
	}

	//endregion


	public function SendVerificationCode_post()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		$response = new stdClass();

		if ($method == 'POST') {

			$check_auth_client = $this->mmodel->check_auth_client();

			if ($check_auth_client == true) {

				//code...

			} else {
				$response->status = REST_Controller::HTTP_UNAUTHORIZED;
				$response->status_code = APIResponseCode::UNAUTHORIZED;
				$response->msg = 'Unauthorized';
				$response->response = NULL;
				$response->error_msg = 'Invalid Authentication Key.';
				$this->response($response, REST_Controller::HTTP_UNAUTHORIZED);
			}

		} else {
			$response->status = REST_Controller::HTTP_METHOD_NOT_ALLOWED;
			$response->status_code = APIResponseCode::METHOD_NOT_ALLOWED;
			$response->msg = 'Method Not Allowed';
			$response->response = NULL;
			$response->error_msg = 'Invalid Request Method.';
			$this->response($response, REST_Controller::HTTP_METHOD_NOT_ALLOWED);
		}
	}


	//region All API for Consultant

	//	public function RegisterConsultant_post()
	//	{
	//		$method = $_SERVER['REQUEST_METHOD'];
	//		$response = new stdClass();
	//		if ($method == 'POST') {
	//
	//			$check_auth_client = $this->mmodel->check_auth_client();
	//
	//			if ($check_auth_client == true) {
	//
	//				// Passing post array to the model.
	//				$this->mdoctor->set_data($this->input->post());
	//
	//				// model it self will validate the input data
	//				if ($this->mdoctor->is_valid()) {
	//
	//					// create the doctor record as the given data is valid
	//					$doctor = $this->mdoctor->create();
	//
	//					if (!is_null($doctor)) {
	//						$response->status = REST_Controller::HTTP_OK;
	//						$response->msg = 'New Doctor Added Successfully';
	//						$response->error_msg = NULL;
	//						$response->response = $doctor;
	//						$this->response($response, REST_Controller::HTTP_OK);
	//					}
	//				} else {
	//					$response->status = REST_Controller::HTTP_BAD_REQUEST;
	//					$response->msg = 'Validation Failed.';
	//					$response->response = NULL;
	//					$response->error_msg = $this->mdoctor->validation_errors;
	//					$this->response($response, REST_Controller::HTTP_BAD_REQUEST);
	//				}
	//			} else {
	//				$response->status = REST_Controller::HTTP_UNAUTHORIZED;
	//				$response->msg = 'Unauthorized';
	//				$response->response = NULL;
	//				$response->error_msg = 'Invalid Authentication Key.';
	//				$this->response($response, REST_Controller::HTTP_UNAUTHORIZED);
	//			}
	//		} else {
	//			$response->status = REST_Controller::HTTP_METHOD_NOT_ALLOWED;
	//			$response->msg = 'Method Not Allowed';
	//			$response->response = NULL;
	//			$response->error_msg = 'Invalid Request Method.';
	//			$this->response($response, REST_Controller::HTTP_METHOD_NOT_ALLOWED);
	//		}
	//	}


	//endregion


	//region All API for Public
	public function RegisterPublic_post()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		$response = new stdClass();
		if ($method == 'POST') {

			$check_auth_client = $this->mmodel->check_auth_client();

			if ($check_auth_client == true) {

				// Passing post array to the model.
				$this->mpublic->set_data($this->input->post());

				// model it self will validate the input data
				if ($this->mpublic->is_valid()) {

					// create the doctor record as the given data is valid
					$public = $this->mpublic->create();

					if (!is_null($public)) {
						$response->status = REST_Controller::HTTP_OK;
						$response->msg = 'New Public Added Successfully';
						$response->error_msg = NULL;
						$response->response = $public;
						$this->response($response, REST_Controller::HTTP_OK);
					}
				} else {
					$response->status = REST_Controller::HTTP_BAD_REQUEST;
					$response->msg = 'Validation Failed.';
					$response->response = NULL;
					$response->error_msg = $this->mpublic->validation_errors;
					$this->response($response, REST_Controller::HTTP_BAD_REQUEST);
				}
			} else {
				$response->status = REST_Controller::HTTP_UNAUTHORIZED;
				$response->msg = 'Unauthorized';
				$response->response = NULL;
				$response->error_msg = 'Invalid Authentication Key.';
				$this->response($response, REST_Controller::HTTP_UNAUTHORIZED);
			}
		} else {
			$response->status = REST_Controller::HTTP_METHOD_NOT_ALLOWED;
			$response->msg = 'Method Not Allowed';
			$response->response = NULL;
			$response->error_msg = 'Invalid Request Method.';
			$this->response($response, REST_Controller::HTTP_METHOD_NOT_ALLOWED);
		}
	}

	public function PublicByUniqueId_get()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		$response = new stdClass();
		if ($method == 'GET') {

			$check_auth_client = $this->mmodel->check_auth_client();

			if ($check_auth_client == true) {

				$public = $this->mpublic->get($this->input->get('id'));

				$response->status = REST_Controller::HTTP_OK;
				$response->msg = 'Public Details';
				$response->error_msg = NULL;
				$response->response = $public;
				$this->response($response, REST_Controller::HTTP_OK);


			} else {
				$response->status = REST_Controller::HTTP_UNAUTHORIZED;
				$response->msg = 'Unauthorized';
				$response->response = NULL;
				$response->error_msg = 'Invalid Authentication Key.';
				$this->response($response, REST_Controller::HTTP_UNAUTHORIZED);
			}
		} else {
			$response->status = REST_Controller::HTTP_METHOD_NOT_ALLOWED;
			$response->msg = 'Method Not Allowed';
			$response->response = NULL;
			$response->error_msg = 'Invalid Request Method.';
			$this->response($response, REST_Controller::HTTP_METHOD_NOT_ALLOWED);
		}
	}

	public function UpdatePublic_put($public_id)
	{
		$method = $_SERVER['REQUEST_METHOD'];
		$response = new stdClass();
		if ($method == 'PUT') {

			$check_auth_client = $this->mmodel->check_auth_client();

			if ($check_auth_client == true) {

				// Passing put array to the model.
				$this->mpublic->set_data($this->put());

				// model it self will validate the input data
				if ($this->mpublic->is_valid()) {

					// update the public record as the given data is valid
					$public = $this->mpublic->update($public_id);

					if (!is_null($public)) {

						$response->status = REST_Controller::HTTP_OK;
						$response->msg = 'Public Updated Successfully';
						$response->error_msg = NULL;
						$response->response = $public;
						$this->response($response, REST_Controller::HTTP_OK);
					} else {
						$response->status = REST_Controller::HTTP_OK;
						$response->msg = 'No Records to Update';
						$response->error_msg = NULL;
						$response->response = $public;
						$this->response($response, REST_Controller::HTTP_OK);
					}
				} else {
					$response->status = REST_Controller::HTTP_BAD_REQUEST;
					$response->msg = 'Validation Failed.';
					$response->response = NULL;
					$response->error_msg = $this->mpublic->validation_errors;
					$this->response($response, REST_Controller::HTTP_BAD_REQUEST);
				}
			} else {
				$response->status = REST_Controller::HTTP_UNAUTHORIZED;
				$response->msg = 'Unauthorized';
				$response->response = NULL;
				$response->error_msg = 'Invalid Authentication Key.';
				$this->response($response, REST_Controller::HTTP_UNAUTHORIZED);
			}
		} else {
			$response->status = REST_Controller::HTTP_METHOD_NOT_ALLOWED;
			$response->msg = 'Method Not Allowed';
			$response->response = NULL;
			$response->error_msg = 'Invalid Request Method.';
			$this->response($response, REST_Controller::HTTP_METHOD_NOT_ALLOWED);
		}
	}

	public function GetAppointmentNumber_get($patient_id = '', $session_id = '')
	{
		$method = $_SERVER['REQUEST_METHOD'];
		$response = new stdClass();
		if ($method == 'GET') {

			$check_auth_client = $this->mmodel->check_auth_client();

			if ($check_auth_client == true) {

				if ($this->mpublic->valid_public($patient_id)) {

					if ($this->mclinicsession->valid_session($session_id)) {

						$number = $this->appointmentserialnumber->create($patient_id, $session_id);

						if (!is_null($number)) {

							$number->serial_number = $this->mserialnumber->get($number->serial_number_id);

							unset($number->serial_number_id);

							$response->status = REST_Controller::HTTP_OK;
							$response->status_code = APIResponseCode::SUCCESS;
							$response->msg = 'Number Details';
							$response->error_msg = '';
							$response->response['appointment_number'] = $number;
							$this->response($response, REST_Controller::HTTP_BAD_REQUEST);
						} else {
							$response->status = REST_Controller::HTTP_INTERNAL_SERVER_ERROR;
							$response->status_code = APIResponseCode::INTERNAL_SERVER_ERROR;
							$response->msg = 'Failed to create number';
							$response->error_msg[] = 'Failed to create number';
							$response->response = null;
							$this->response($response, REST_Controller::HTTP_BAD_REQUEST);
						}

					} else {
						$response->status = REST_Controller::HTTP_BAD_REQUEST;
						$response->status_code = APIResponseCode::BAD_REQUEST;
						$response->msg = 'Invalid Session Id';
						$response->error_msg[] = 'Invalid Session Id';
						$response->response = NULL;
						$this->response($response, REST_Controller::HTTP_BAD_REQUEST);
					}

				} else {
					$response->status = REST_Controller::HTTP_BAD_REQUEST;
					$response->status_code = APIResponseCode::BAD_REQUEST;
					$response->msg = 'Invalid Public Id';
					$response->error_msg[] = 'Invalid Public Id';
					$response->response = NULL;
					$this->response($response, REST_Controller::HTTP_BAD_REQUEST);
				}

			} else {
				$response->status = REST_Controller::HTTP_UNAUTHORIZED;
				$response->msg = 'Unauthorized';
				$response->error_msg[] = 'Invalid Authentication Key.';
				$response->response = NULL;
				$this->response($response, REST_Controller::HTTP_UNAUTHORIZED);
			}
		} else {
			$response->status = REST_Controller::HTTP_METHOD_NOT_ALLOWED;
			$response->msg = 'Method Not Allowed';
			$response->error_msg[] = 'Invalid Request Method.';
			$response->response = NULL;
			$this->response($response, REST_Controller::HTTP_METHOD_NOT_ALLOWED);
		}
	}

	public function BookAppointment_post($patient_id = '', $session_id = '')
	{
		$method = $_SERVER['REQUEST_METHOD'];
		$response = new stdClass();
		if ($method == 'POST') {

			$check_auth_client = $this->mmodel->check_auth_client();

			if ($check_auth_client == true) {


				if ($this->mpublic->valid_public($patient_id)) {

					if ($this->mclinicsession->valid_session($session_id)) {

						$json_data = $this->post('json_data');

						$number = $this->appointmentserialnumber->get_appointment_number($patient_id, $session_id);

						if (!is_null($number)) {
							if ($json_data['serial_number_id'] == $number->serial_number_id) {

								//confirm booking
								$appointment = $this->mclinicappointment->create($patient_id, $session_id, $number->serial_number_id, $number->id);

								if (!is_null($appointment)) {

									$appointment->serial_number = $this->mserialnumber->get($appointment->serial_number_id);

									unset($appointment->serial_number_id);

									$response->status = REST_Controller::HTTP_OK;
									$response->status_code = APIResponseCode::SUCCESS;
									$response->msg = 'Appointment Details';
									$response->error_msg = '';
									$response->response['appointment_details'] = $appointment;
									$this->response($response, REST_Controller::HTTP_BAD_REQUEST);
								} else {
									$response->status = REST_Controller::HTTP_INTERNAL_SERVER_ERROR;
									$response->status_code = APIResponseCode::INTERNAL_SERVER_ERROR;
									$response->msg = 'Failed to create Appointment';
									$response->error_msg[] = 'Failed to create Appointment';
									$response->response = null;
									$this->response($response, REST_Controller::HTTP_BAD_REQUEST);
								}


							} else {
								$response->status = REST_Controller::HTTP_BAD_REQUEST;
								$response->status_code = APIResponseCode::BAD_REQUEST;
								$response->msg = 'Invalid Serial Number';
								$response->error_msg[] = 'Invalid Serial Number';
								$response->response = NULL;
								$this->response($response, REST_Controller::HTTP_BAD_REQUEST);
							}
						} else {
							$response->status = REST_Controller::HTTP_BAD_REQUEST;
							$response->status_code = APIResponseCode::BAD_REQUEST;
							$response->msg = 'Number Expired';
							$response->error_msg[] = 'Number Expired';
							$response->response = NULL;
							$this->response($response, REST_Controller::HTTP_BAD_REQUEST);
						}


					} else {
						$response->status = REST_Controller::HTTP_BAD_REQUEST;
						$response->status_code = APIResponseCode::BAD_REQUEST;
						$response->msg = 'Invalid Session Id';
						$response->error_msg[] = 'Invalid Session Id';
						$response->response = NULL;
						$this->response($response, REST_Controller::HTTP_BAD_REQUEST);
					}

				} else {
					$response->status = REST_Controller::HTTP_BAD_REQUEST;
					$response->status_code = APIResponseCode::BAD_REQUEST;
					$response->msg = 'Invalid Public Id';
					$response->error_msg[] = 'Invalid Public Id';
					$response->response = NULL;
					$this->response($response, REST_Controller::HTTP_BAD_REQUEST);
				}
			} else {
				$response->status = REST_Controller::HTTP_UNAUTHORIZED;
				$response->status_code = APIResponseCode::UNAUTHORIZED;
				$response->msg = 'Unauthorized';
				$response->response = NULL;
				$response->error_msg = 'Invalid Authentication Key.';
				$this->response($response, REST_Controller::HTTP_UNAUTHORIZED);
			}
		} else {
			$response->status = REST_Controller::HTTP_METHOD_NOT_ALLOWED;
			$response->status_code = APIResponseCode::METHOD_NOT_ALLOWED;
			$response->msg = 'Method Not Allowed';
			$response->response = NULL;
			$response->error_msg = 'Invalid Request Method.';
			$this->response($response, REST_Controller::HTTP_METHOD_NOT_ALLOWED);
		}

	}


	//endregion


	//region All API For Clinic

	public function CreateClinic_post()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		$response = new stdClass();
		if ($method == 'POST') {

			$check_auth_client = $this->mmodel->check_auth_client();

			if ($check_auth_client == true) {

				$json_data = $this->post('json_data');

				// Passing post array to the model.
				$this->mclinic->set_data($json_data);

				// model it self will validate the input data
				if ($this->mclinic->is_valid()) {

					$this->mlocations->set_data($json_data);

					//Validate location data
					if ($this->mlocations->is_valid()) {

						// create the Location record as the given data is valid
						$locations = $this->mlocations->create();

						if (!is_null($locations)) {
							// create the Clinic record as the given data is valid
							$clinic = $this->mclinic->create($locations->id);


							if (!is_null($clinic)) {

								$login_data['username'] = $json_data['email'];
								$login_data['password'] = $json_data["password"];
								$login_data['mobile'] = $json_data["device_mobile"];

								$this->mlogin->set_data($login_data);

								$login = $this->mlogin->create($clinic->id, EntityType::Consultant); // return true or false

								if ($login) {
									$this->motpcode->create($clinic->id, $login_data['mobile']);
								}

								$clinic->location = $locations;

								$response->status = REST_Controller::HTTP_OK;
								$response->status_code = APIResponseCode::SUCCESS;
								$response->msg = 'New Clinic Added Successfully';
								$response->error_msg = NULL;
								$response->response = $clinic;
								$this->response($response, REST_Controller::HTTP_OK);
							} else {
								$response->status = REST_Controller::HTTP_INTERNAL_SERVER_ERROR;
								$response->status_code = APIResponseCode::INTERNAL_SERVER_ERROR;
								$response->msg = NULL;
								$response->error_msg[] = 'Internal Server Error';
								$response->response = NULL;
								$this->response($response, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
							}
						} else {
							$response->status = REST_Controller::HTTP_INTERNAL_SERVER_ERROR;
							$response->status_code = APIResponseCode::INTERNAL_SERVER_ERROR;
							$response->msg = NULL;
							$response->error_msg = 'Internal Server Error';
							$response->response = NULL;
							$this->response($response, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
						}
					} else {
						$response->status = REST_Controller::HTTP_BAD_REQUEST;
						$response->status_code = APIResponseCode::BAD_REQUEST;
						$response->msg = 'Validation Failed.';
						$response->response = NULL;
						$response->error_msg = $this->mlocations->validation_errors;
						$this->response($response, REST_Controller::HTTP_BAD_REQUEST);
					}

				} else {
					$response->status = REST_Controller::HTTP_BAD_REQUEST;
					$response->status_code = APIResponseCode::BAD_REQUEST;
					$response->msg = 'Validation Failed.';
					$response->response = NULL;
					$response->error_msg = $this->mclinic->validation_errors;
					$this->response($response, REST_Controller::HTTP_BAD_REQUEST);
				}
			} else {
				$response->status = REST_Controller::HTTP_UNAUTHORIZED;
				$response->status_code = APIResponseCode::UNAUTHORIZED;
				$response->msg = 'Unauthorized';
				$response->response = NULL;
				$response->error_msg[] = 'Invalid Authentication Key.';
				$this->response($response, REST_Controller::HTTP_UNAUTHORIZED);
			}
		} else {
			$response->status = REST_Controller::HTTP_METHOD_NOT_ALLOWED;
			$response->status_code = APIResponseCode::METHOD_NOT_ALLOWED;
			$response->msg = 'Method Not Allowed';
			$response->response = NULL;
			$response->error_msg[] = 'Invalid Request Method.';
			$this->response($response, REST_Controller::HTTP_METHOD_NOT_ALLOWED);
		}

	}

	public function ValidateOTP_put($clinic_id = '')
	{
		$method = $_SERVER['REQUEST_METHOD'];
		$response = new stdClass();
		if ($method == 'PUT') {

			$check_auth_client = $this->mmodel->check_auth_client();

			if ($check_auth_client == true) {

				$this->motpcode->set_data($this->put('json_data'));


				if ($this->motpcode->is_valid($clinic_id)) {

					$response->status = REST_Controller::HTTP_OK;
					$response->status_code = APIResponseCode::SUCCESS;
					$response->msg = 'OTP Validation Successful..';
					$response->error_msg = NULL;
//					$response->response = (object) array('OTP Validation Successful..');
					$response->response['msg'] = 'OTP Validation Successful..';
					$this->response($response, REST_Controller::HTTP_OK);

				} else {
					$response->status = REST_Controller::HTTP_BAD_REQUEST;
					$response->status_code = APIResponseCode::BAD_REQUEST;
					$response->msg = 'Validation Failed.';
					$response->response = NULL;
					$response->error_msg = $this->motpcode->validation_errors;
					$this->response($response, REST_Controller::HTTP_BAD_REQUEST);
				}
			} else {
				$response->status = REST_Controller::HTTP_UNAUTHORIZED;
				$response->status_code = APIResponseCode::UNAUTHORIZED;
				$response->msg = 'Unauthorized';
				$response->response = NULL;
				$response->error_msg[] = 'Invalid Authentication Key.';
				$this->response($response, REST_Controller::HTTP_UNAUTHORIZED);
			}
		} else {
			$response->status = REST_Controller::HTTP_METHOD_NOT_ALLOWED;
			$response->status_code = APIResponseCode::METHOD_NOT_ALLOWED;
			$response->msg = 'Method Not Allowed';
			$response->response = NULL;
			$response->error_msg[] = 'Invalid Request Method.';
			$this->response($response, REST_Controller::HTTP_METHOD_NOT_ALLOWED);
		}
	}

	public function ResendOTP_put($clinic_id = '')
	{
		$method = $_SERVER['REQUEST_METHOD'];
		$response = new stdClass();
		if ($method == 'PUT') {

			$check_auth_client = $this->mmodel->check_auth_client();

			if ($check_auth_client == true) {

				if ($this->mclinic->valid_clinic($clinic_id)) {

					if ($this->motpcode->resend_otp($clinic_id)) {
						$response->status = REST_Controller::HTTP_OK;
						$response->status_code = APIResponseCode::SUCCESS;
						$response->msg = 'OTP send successfully..';
						$response->error_msg = NULL;
						$response->response = NULL;
						$this->response($response, REST_Controller::HTTP_BAD_REQUEST);
					} else {
						$response->status = REST_Controller::HTTP_INTERNAL_SERVER_ERROR;
						$response->status_code = APIResponseCode::INTERNAL_SERVER_ERROR;
						$response->msg = 'Failed to send OTP..';
						$response->error_msg[] = 'Failed to send OTP..';
						$response->response = NULL;
						$this->response($response, REST_Controller::HTTP_BAD_REQUEST);
					}
				} else {
					$response->status = REST_Controller::HTTP_BAD_REQUEST;
					$response->status_code = APIResponseCode::BAD_REQUEST;
					$response->msg = 'Invalid Clinic Id';
					$response->error_msg[] = 'Invalid Clinic Id';
					$response->response = NULL;
					$this->response($response, REST_Controller::HTTP_BAD_REQUEST);
				}
			} else {
				$response->status = REST_Controller::HTTP_UNAUTHORIZED;
				$response->status_code = APIResponseCode::UNAUTHORIZED;
				$response->msg = 'Unauthorized';
				$response->error_msg[] = 'Invalid Authentication Key.';
				$response->response = NULL;
				$this->response($response, REST_Controller::HTTP_UNAUTHORIZED);
			}
		} else {
			$response->status = REST_Controller::HTTP_METHOD_NOT_ALLOWED;
			$response->status_code = APIResponseCode::METHOD_NOT_ALLOWED;
			$response->msg = 'Method Not Allowed';
			$response->error_msg[] = 'Invalid Request Method.';
			$response->response = NULL;
			$this->response($response, REST_Controller::HTTP_METHOD_NOT_ALLOWED);
		}
	}

	public function SendOTPforUsername_put()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		$response = new stdClass();
		if ($method == 'PUT') {

			$check_auth_client = $this->mmodel->check_auth_client();

			if ($check_auth_client == true) {

				$json_data = $this->put('json_data');

				if ($this->mlogin->check_valid_account($json_data['username'])) {

					if ($this->mlogin->get_login_for_username($json_data['username'])->entity_id != null) {

						$this->ResendOTP_put($this->mlogin->get_login_for_username($json_data['username'])->entity_id);

					} else {
						$response->status = REST_Controller::HTTP_BAD_REQUEST;
						$response->status_code = APIResponseCode::BAD_REQUEST;
						$response->msg = 'Invalid Username..';
						$response->error_msg[] = 'Invalid Username..';
						$response->response = NULL;
						$this->response($response, REST_Controller::HTTP_BAD_REQUEST);
					}
				} else {
					$response->status = REST_Controller::HTTP_BAD_REQUEST;
					$response->status_code = APIResponseCode::BAD_REQUEST;
					$response->msg = 'Validation Failed.';
					$response->error_msg = $this->mlogin->validation_errors;
					$response->response = NULL;
					$this->response($response, REST_Controller::HTTP_BAD_REQUEST);
				}
			} else {
				$response->status = REST_Controller::HTTP_UNAUTHORIZED;
				$response->status_code = APIResponseCode::UNAUTHORIZED;
				$response->msg = 'Unauthorized';
				$response->error_msg[] = 'Invalid Authentication Key.';
				$response->response = NULL;
				$this->response($response, REST_Controller::HTTP_UNAUTHORIZED);
			}
		} else {
			$response->status = REST_Controller::HTTP_METHOD_NOT_ALLOWED;
			$response->status_code = APIResponseCode::METHOD_NOT_ALLOWED;
			$response->msg = 'Method Not Allowed';
			$response->error_msg[] = 'Invalid Request Method.';
			$response->response = NULL;
			$this->response($response, REST_Controller::HTTP_METHOD_NOT_ALLOWED);
		}
	}

	public function ClinicByUniqueId_get($clinic_id = '')
	{
		$method = $_SERVER['REQUEST_METHOD'];
		$response = new stdClass();
		if ($method == 'GET') {

			$check_auth_client = $this->mmodel->check_auth_client();

			if ($check_auth_client == true) {

				$clinic = $this->mclinic->get($clinic_id);
				$clinic->location = $this->mlocations->get($clinic->location);

				$response->status = REST_Controller::HTTP_OK;
				$response->status_code = APIResponseCode::SUCCESS;
				$response->msg = 'Clinic Details';
				$response->error_msg = NULL;
				$response->response = $clinic;
				$this->response($response, REST_Controller::HTTP_OK);


			} else {
				$response->status = REST_Controller::HTTP_UNAUTHORIZED;
				$response->status_code = APIResponseCode::UNAUTHORIZED;
				$response->msg = 'Unauthorized';
				$response->response = NULL;
				$response->error_msg[] = 'Invalid Authentication Key.';
				$this->response($response, REST_Controller::HTTP_UNAUTHORIZED);
			}
		} else {
			$response->status = REST_Controller::HTTP_METHOD_NOT_ALLOWED;
			$response->status_code = APIResponseCode::METHOD_NOT_ALLOWED;
			$response->msg = 'Method Not Allowed';
			$response->response = NULL;
			$response->error_msg[] = 'Invalid Request Method.';
			$this->response($response, REST_Controller::HTTP_METHOD_NOT_ALLOWED);
		}
	}

	public function RegisterConsultant_post($clinic_id = '')
	{
		$method = $_SERVER['REQUEST_METHOD'];
		$response = new stdClass();
		$inserted_records = array();
		$validation_errors = array();


		if ($method == 'POST') {

			$json_data = ($this->post('json_data'));

			$check_auth_client = $this->mmodel->check_auth_client();

			if ($check_auth_client == true) {

				if ($this->mclinic->valid_clinic($clinic_id)) {
					foreach ($json_data['substitute'] as $substitute) {

						// Passing post array to the model.
						$this->mdoctor->set_data($substitute);

						// model it self will validate the input data
						if ($this->mdoctor->is_valid()) {

							// create the doctor record as the given data is valid
							$doctor = $this->mdoctor->create();

							if (!is_null($doctor)) {

								if ($this->mconsultantpool->create($doctor->id, $clinic_id) == true) {
									$inserted_records[] = $doctor;
								}
							}
						} else {
							$errors['msg'] = 'Validation Failed.';
//							$errors['request_data'] = $substitute;
							$errors['errors'] = $this->mdoctor->validation_errors;
							$validation_errors[] = $errors;
						}
					}

					if (sizeof($validation_errors) == 0) {
						$response->status = REST_Controller::HTTP_OK;
						$response->status_code = APIResponseCode::SUCCESS;
						$response->msg = 'Success';
						$response->error_msg = NULL;
						$response->response['clinic'] = $clinic_id;
						$response->response['substitutes'] = $inserted_records;
						$response->error_msg = null;
						$this->response($response, REST_Controller::HTTP_OK);
					} else {
						$response->status = REST_Controller::HTTP_OK;
						$response->status_code = APIResponseCode::SUCCESS_WITH_ERRORS;
						$response->msg = 'Success';
						$response->error_msg = NULL;
						$response->response['clinic'] = $clinic_id;
						$response->response['substitutes'] = $inserted_records;
						$response->error_msg = $validation_errors;
						$this->response($response, REST_Controller::HTTP_OK);
					}


				} else {
					$response->status = REST_Controller::HTTP_BAD_REQUEST;
					$response->status_code = APIResponseCode::BAD_REQUEST;
					$response->msg = 'Invalid Clinic Id';
					$response->error_msg[] = 'Invalid Clinic Id';
					$response->response = NULL;
					$this->response($response, REST_Controller::HTTP_BAD_REQUEST);
				}
			} else {
				$response->status = REST_Controller::HTTP_UNAUTHORIZED;
				$response->status_code = APIResponseCode::UNAUTHORIZED;
				$response->msg = 'Unauthorized';
				$response->response = NULL;
				$response->error_msg[] = 'Invalid Authentication Key.';
				$this->response($response, REST_Controller::HTTP_UNAUTHORIZED);
			}
		} else {
			$response->status = REST_Controller::HTTP_METHOD_NOT_ALLOWED;
			$response->status_code = APIResponseCode::METHOD_NOT_ALLOWED;
			$response->msg = 'Method Not Allowed';
			$response->response = NULL;
			$response->error_msg[] = 'Invalid Request Method.';
			$this->response($response, REST_Controller::HTTP_METHOD_NOT_ALLOWED);
		}
	}

	public function ConsultantByUniqueId_get($consultant_id = '')
	{
		$method = $_SERVER['REQUEST_METHOD'];
		$response = new stdClass();
		if ($method == 'GET') {

			$check_auth_client = $this->mmodel->check_auth_client();

			if ($check_auth_client == true) {

				$doctor = $this->mdoctor->get($consultant_id);

				$response->status = REST_Controller::HTTP_OK;
				$response->status_code = APIResponseCode::SUCCESS;
				$response->msg = 'Doctor Details';
				$response->error_msg = NULL;
				$response->response = $doctor;
				$this->response($response, REST_Controller::HTTP_OK);


			} else {
				$response->status = REST_Controller::HTTP_UNAUTHORIZED;
				$response->status_code = APIResponseCode::UNAUTHORIZED;
				$response->msg = 'Unauthorized';
				$response->response = NULL;
				$response->error_msg[] = 'Invalid Authentication Key.';
				$this->response($response, REST_Controller::HTTP_UNAUTHORIZED);
			}
		} else {
			$response->status = REST_Controller::HTTP_METHOD_NOT_ALLOWED;
			$response->status_code = APIResponseCode::METHOD_NOT_ALLOWED;
			$response->msg = 'Method Not Allowed';
			$response->response = NULL;
			$response->error_msg[] = 'Invalid Request Method.';
			$this->response($response, REST_Controller::HTTP_METHOD_NOT_ALLOWED);
		}
	}

	public function GetConsultantforClinic_get($clinic_id = '')
	{
		$method = $_SERVER['REQUEST_METHOD'];
		$response = new stdClass();
		if ($method == 'GET') {

			$check_auth_client = $this->mmodel->check_auth_client();

			if ($check_auth_client == true) {


				if ($this->mclinic->valid_clinic($clinic_id)) {

					$consultant_list = $this->mconsultantpool->get_consultant_for_clinic($clinic_id);


					$response->status = REST_Controller::HTTP_OK;
					$response->status_code = APIResponseCode::SUCCESS;
					$response->msg = 'Consultants for Clinic';
					$response->error_msg = NULL;
					$response->response['consultant'] = $consultant_list;
					$this->response($response, REST_Controller::HTTP_OK);

				} else {
					$response->status = REST_Controller::HTTP_BAD_REQUEST;
					$response->status_code = APIResponseCode::BAD_REQUEST;
					$response->msg = 'Invalid Clinic Id';
					$response->error_msg[] = 'Invalid Clinic Id';
					$response->response = NULL;
//					$response->request_data = $this->post();
					$this->response($response, REST_Controller::HTTP_BAD_REQUEST);

				}

			} else {
				$response->status = REST_Controller::HTTP_UNAUTHORIZED;
				$response->status_code = APIResponseCode::UNAUTHORIZED;
				$response->msg = 'Unauthorized';
				$response->response = NULL;
				$response->error_msg[] = 'Invalid Authentication Key.';
				$this->response($response, REST_Controller::HTTP_UNAUTHORIZED);
			}
		} else {
			$response->status = REST_Controller::HTTP_METHOD_NOT_ALLOWED;
			$response->status_code = APIResponseCode::METHOD_NOT_ALLOWED;
			$response->msg = 'Method Not Allowed';
			$response->response = NULL;
			$response->error_msg[] = 'Invalid Request Method.';
			$this->response($response, REST_Controller::HTTP_METHOD_NOT_ALLOWED);
		}
	}

	public function UpdateConsultant_put($doctor_id = '')
	{
		$method = $_SERVER['REQUEST_METHOD'];
		$response = new stdClass();
		if ($method == 'PUT') {

			$check_auth_client = $this->mmodel->check_auth_client();

			if ($check_auth_client == true) {

				// Passing put array to the model.
				$this->mdoctor->set_data($this->put());

				// model it self will validate the input data
				if ($this->mdoctor->is_valid()) {

					// update the doctor record as the given data is valid
					$doctor = $this->mdoctor->update($doctor_id);

					if (!is_null($doctor)) {

						unset($mdoctor);

						$response->status = REST_Controller::HTTP_OK;
						$response->status_code = APIResponseCode::SUCCESS;
						$response->msg = 'Doctor Updated Successfully';
						$response->error_msg = NULL;
						$response->response = $doctor;
						$this->response($response, REST_Controller::HTTP_OK);
					} else {
						$response->status = REST_Controller::HTTP_OK;
						$response->status_code = APIResponseCode::SUCCESS;
						$response->msg = 'No Records to Update';
						$response->error_msg = NULL;
						$response->response = $doctor;
						$this->response($response, REST_Controller::HTTP_OK);
					}
				} else {
					$response->status = REST_Controller::HTTP_BAD_REQUEST;
					$response->status_code = APIResponseCode::BAD_REQUEST;
					$response->msg = 'Validation Failed.';
					$response->response = NULL;
					$response->error_msg = $this->mdoctor->validation_errors;
					$this->response($response, REST_Controller::HTTP_BAD_REQUEST);
				}
			} else {
				$response->status = REST_Controller::HTTP_UNAUTHORIZED;
				$response->status_code = APIResponseCode::UNAUTHORIZED;
				$response->msg = 'Unauthorized';
				$response->response = NULL;
				$response->error_msg = 'Invalid Authentication Key.';
				$this->response($response, REST_Controller::HTTP_UNAUTHORIZED);
			}
		} else {
			$response->status = REST_Controller::HTTP_METHOD_NOT_ALLOWED;
			$response->status_code = APIResponseCode::METHOD_NOT_ALLOWED;
			$response->msg = 'Method Not Allowed';
			$response->response = NULL;
			$response->error_msg = 'Invalid Request Method.';
			$this->response($response, REST_Controller::HTTP_METHOD_NOT_ALLOWED);
		}
	}  //need to recheck

	public function AddClinicSessions_post($clinic_id = '')
	{
		$method = $_SERVER['REQUEST_METHOD'];
		$response = new stdClass();
		$inserted_records = array();
		$validation_errors = array();

		if ($method == 'POST') {

			$check_auth_client = $this->mmodel->check_auth_client();

			if ($check_auth_client == true) {

				if ($this->mclinic->valid_clinic($clinic_id)) {

					$json_data = ($this->post('json_data'));

					foreach ($json_data['session'] as $session) {

						// Passing post array to the model.
						$this->mclinicsession->set_data($session);

						// model it self will validate the input data
						if ($this->mclinicsession->is_valid()) {

							// create the doctor record as the given data is valid
							$clinic_session = $this->mclinicsession->create($clinic_id);

							$inserted_records[] = $clinic_session;

						} else {
							$errors['msg'] = 'Validation Failed.';
							$errors['request_data'] = $session;
							$errors['errors'] = $this->mclinicsession->validation_errors;
							$validation_errors[] = $errors;
						}
					}
					$response->status = REST_Controller::HTTP_OK;
					$response->status_code = APIResponseCode::SUCCESS;
					$response->msg = 'Success';
					$response->error_msg = NULL;
					$response->response['sessions'] = $inserted_records;
					$response->validation_errors = $validation_errors;
					$this->response($response, REST_Controller::HTTP_OK);

				} else {
					$response->status = REST_Controller::HTTP_BAD_REQUEST;
					$response->status_code = APIResponseCode::BAD_REQUEST;
					$response->msg = 'Invalid Clinic Id';
					$response->error_msg = NULL;
					$response->response = NULL;
					$this->response($response, REST_Controller::HTTP_BAD_REQUEST);
				}

			} else {
				$response->status = REST_Controller::HTTP_UNAUTHORIZED;
				$response->status_code = APIResponseCode::UNAUTHORIZED;
				$response->msg = 'Unauthorized';
				$response->error_msg[] = 'Invalid Authentication Key.';
				$response->response = NULL;
				$this->response($response, REST_Controller::HTTP_UNAUTHORIZED);
			}

		} else {
			$response->status = REST_Controller::HTTP_METHOD_NOT_ALLOWED;
			$response->status_code = APIResponseCode::METHOD_NOT_ALLOWED;
			$response->msg = 'Method Not Allowed';
			$response->error_msg[] = 'Invalid Request Method.';
			$response->response = NULL;
			$this->response($response, REST_Controller::HTTP_METHOD_NOT_ALLOWED);
		}
	}

	public function ViewSessionsByDay_get($clinic_id = '', $date = '')
	{
		$method = $_SERVER['REQUEST_METHOD'];
		$response = new stdClass();
		if ($method == 'GET') {

			$check_auth_client = $this->mmodel->check_auth_client();

			if ($check_auth_client == true) {

				if ($this->mclinic->valid_clinic($clinic_id)) {

					if (!($date != '' && $this->mvalidation->valid_date($date))) {

						$response->status = REST_Controller::HTTP_BAD_REQUEST;
						$response->status_code = APIResponseCode::BAD_REQUEST;
						$response->msg = 'Invalid Date';
						$response->error_msg[] = 'Invalid Date';
						$response->response = NULL;
						$this->response($response, REST_Controller::HTTP_BAD_REQUEST);

					} else {

						$sessions = $this->mclinicsession->get_sessions_for_day($clinic_id, $date);

						$response->status = REST_Controller::HTTP_OK;
						$response->status_code = APIResponseCode::SUCCESS;
						$response->msg = 'Session Details';
						$response->error_msg[] = NULL;
						$response->response['sessions'] = $sessions;
						$this->response($response, REST_Controller::HTTP_OK);
					}

				} else {
					$response->status = REST_Controller::HTTP_BAD_REQUEST;
					$response->status_code = APIResponseCode::BAD_REQUEST;
					$response->msg = 'Invalid Clinic Id';
					$response->error_msg = NULL;
					$response->response = NULL;
					$this->response($response, REST_Controller::HTTP_BAD_REQUEST);
				}

			} else {
				$response->status = REST_Controller::HTTP_UNAUTHORIZED;
				$response->status_code = APIResponseCode::UNAUTHORIZED;
				$response->msg = 'Unauthorized';
				$response->response = NULL;
				$response->error_msg[] = 'Invalid Authentication Key.';
				$this->response($response, REST_Controller::HTTP_UNAUTHORIZED);
			}
		} else {
			$response->status = REST_Controller::HTTP_METHOD_NOT_ALLOWED;
			$response->status_code = APIResponseCode::METHOD_NOT_ALLOWED;
			$response->msg = 'Method Not Allowed';
			$response->response = NULL;
			$response->error_msg[] = 'Invalid Request Method.';
			$this->response($response, REST_Controller::HTTP_METHOD_NOT_ALLOWED);
		}
	}

	public function ViewSessionsByID_get($clinic_id = '', $session_id = '')
	{
		$method = $_SERVER['REQUEST_METHOD'];
		$response = new stdClass();
		if ($method == 'GET') {

			$check_auth_client = $this->mmodel->check_auth_client();

			if ($check_auth_client == true) {

				if ($this->mclinic->valid_clinic($clinic_id)) {

					if ($this->mclinicsession->valid_session($session_id)) {

						$sessions = $this->mclinicsession->get($session_id);

						$response->status = REST_Controller::HTTP_OK;
						$response->status_code = APIResponseCode::SUCCESS;
						$response->msg = 'Session Details';
						$response->error_msg = NULL;
						$response->response['sessions'] = $sessions;
						$this->response($response, REST_Controller::HTTP_OK);

					} else {

						$response->status = REST_Controller::HTTP_BAD_REQUEST;
						$response->status_code = APIResponseCode::BAD_REQUEST;
						$response->msg = 'Invalid Session';
						$response->error_msg[] = 'Invalid Session';
						$response->response = NULL;
						$this->response($response, REST_Controller::HTTP_BAD_REQUEST);
					}

				} else {
					$response->status = REST_Controller::HTTP_BAD_REQUEST;
					$response->status_code = APIResponseCode::BAD_REQUEST;
					$response->msg = 'Invalid Clinic Id';
					$response->error_msg = NULL;
					$response->response = NULL;
					$this->response($response, REST_Controller::HTTP_BAD_REQUEST);
				}

			} else {
				$response->status = REST_Controller::HTTP_UNAUTHORIZED;
				$response->status_code = APIResponseCode::UNAUTHORIZED;
				$response->msg = 'Unauthorized';
				$response->response = NULL;
				$response->error_msg[] = 'Invalid Authentication Key.';
				$this->response($response, REST_Controller::HTTP_UNAUTHORIZED);
			}
		} else {
			$response->status = REST_Controller::HTTP_METHOD_NOT_ALLOWED;
			$response->status_code = APIResponseCode::METHOD_NOT_ALLOWED;
			$response->msg = 'Method Not Allowed';
			$response->response = NULL;
			$response->error_msg[] = 'Invalid Request Method.';
			$this->response($response, REST_Controller::HTTP_METHOD_NOT_ALLOWED);
		}
	}

	public function ViewSessionsByConsultant_get($clinic_id = '', $consultant_id = '')
	{
		$method = $_SERVER['REQUEST_METHOD'];
		$response = new stdClass();
		if ($method == 'GET') {

			$check_auth_client = $this->mmodel->check_auth_client();

			if ($check_auth_client == true) {

				if ($this->mclinic->valid_clinic($clinic_id)) {

					if ($this->mdoctor->valid_doctor($consultant_id)) {

						$sessions = $this->mclinicsession->get_sessions_for_consultant($clinic_id,$consultant_id);

						$response->status = REST_Controller::HTTP_OK;
						$response->status_code = APIResponseCode::SUCCESS;
						$response->msg = 'Session Details for Consultant';
						$response->error_msg = NULL;
						$response->response['sessions'] = $sessions;
						$this->response($response, REST_Controller::HTTP_OK);

					} else {
						$response->status = REST_Controller::HTTP_BAD_REQUEST;
						$response->status_code = APIResponseCode::BAD_REQUEST;
						$response->msg = 'Invalid Session';
						$response->error_msg[] = 'Invalid Session';
						$response->response = NULL;
						$this->response($response, REST_Controller::HTTP_BAD_REQUEST);
					}

				} else {
					$response->status = REST_Controller::HTTP_BAD_REQUEST;
					$response->status_code = APIResponseCode::BAD_REQUEST;
					$response->msg = 'Invalid Clinic Id';
					$response->error_msg = NULL;
					$response->response = NULL;
					$this->response($response, REST_Controller::HTTP_BAD_REQUEST);
				}

			} else {
				$response->status = REST_Controller::HTTP_UNAUTHORIZED;
				$response->status_code = APIResponseCode::UNAUTHORIZED;
				$response->msg = 'Unauthorized';
				$response->response = NULL;
				$response->error_msg[] = 'Invalid Authentication Key.';
				$this->response($response, REST_Controller::HTTP_UNAUTHORIZED);
			}
		} else {
			$response->status = REST_Controller::HTTP_METHOD_NOT_ALLOWED;
			$response->status_code = APIResponseCode::METHOD_NOT_ALLOWED;
			$response->msg = 'Method Not Allowed';
			$response->response = NULL;
			$response->error_msg[] = 'Invalid Request Method.';
			$this->response($response, REST_Controller::HTTP_METHOD_NOT_ALLOWED);
		}
	}

	public function AddHolidays_post($clinic_id = '')
	{
		$method = $_SERVER['REQUEST_METHOD'];
		$response = new stdClass();

		if ($method == 'POST') {

			$check_auth_client = $this->mmodel->check_auth_client();

			if ($check_auth_client == true) {

				if ($this->mclinic->valid_clinic($clinic_id)) {

					$this->mclinicholidays->set_data($this->post('json_data'));

					//Validate location data
					if ($this->mclinicholidays->is_valid()) {


						// create the holiday record as the given data is valid
						$holiday = $this->mclinicholidays->create($clinic_id);

						if (!is_null($holiday)) {
							$response->status = REST_Controller::HTTP_OK;
							$response->status_code = APIResponseCode::SUCCESS;
							$response->msg = 'New Holiday Added Successfully';
							$response->error_msg = NULL;
							$response->response['holiday'] = $holiday;
							$this->response($response, REST_Controller::HTTP_OK);
						}
					} else {
						$response->status = REST_Controller::HTTP_BAD_REQUEST;
						$response->status_code = APIResponseCode::BAD_REQUEST;
						$response->msg = 'Validation Failed.';
						$response->error_msg = $this->mclinicholidays->validation_errors;
						$response->response = NULL;
						$this->response($response, REST_Controller::HTTP_BAD_REQUEST);
					}


				} else {
					$response->status = REST_Controller::HTTP_BAD_REQUEST;
					$response->status_code = APIResponseCode::BAD_REQUEST;
					$response->msg = 'Invalid Clinic Id';
					$response->error_msg[] = 'Invalid Clinic Id';
					$response->response = NULL;
					$this->response($response, REST_Controller::HTTP_BAD_REQUEST);
				}

			} else {
				$response->status = REST_Controller::HTTP_UNAUTHORIZED;
				$response->status_code = APIResponseCode::UNAUTHORIZED;
				$response->msg = 'Unauthorized';
				$response->error_msg[] = 'Invalid Authentication Key.';
				$response->response = NULL;
				$this->response($response, REST_Controller::HTTP_UNAUTHORIZED);
			}
		} else {
			$response->status = REST_Controller::HTTP_METHOD_NOT_ALLOWED;
			$response->status_code = APIResponseCode::METHOD_NOT_ALLOWED;
			$response->msg = 'Method Not Allowed';
			$response->error_msg[] = 'Invalid Request Method.';
			$response->response = NULL;
			$this->response($response, REST_Controller::HTTP_METHOD_NOT_ALLOWED);
		}
	}

	public function StartSession_put($clinic_id = '', $session_id = '')
	{
		$method = $_SERVER['REQUEST_METHOD'];
		$response = new stdClass();

		if ($method == 'PUT') {

			$check_auth_client = $this->mmodel->check_auth_client();

			if ($check_auth_client == true) {

				if ($this->mclinic->valid_clinic($clinic_id)) {

					if ($this->mclinicsession->valid_session($session_id)) {

						if ($this->mclinicsessiontrans->start_session($session_id)) {

							$appointment = $this->mclinicappointment->get_next_appointment($session_id);

							if (!is_null($appointment)) {

								$response->status = REST_Controller::HTTP_OK;
								$response->status_code = APIResponseCode::SUCCESS;
								$response->msg = 'Session Start Successfully';
								$response->response = $appointment;
								$this->response($response, REST_Controller::HTTP_OK);

							} else {
								$response->status = REST_Controller::HTTP_OK;
								$response->status_code = APIResponseCode::SUCCESS;
								$response->msg = 'No Appointments for today';
								$response->response = NULL;
								$this->response($response, REST_Controller::HTTP_OK);
							}
						} else {
							$response->status = REST_Controller::HTTP_INTERNAL_SERVER_ERROR;
							$response->status_code = APIResponseCode::INTERNAL_SERVER_ERROR;
							$response->msg = 'Internal Server Error';
							$response->response[] = "Internal Server Error";
							$this->response($response, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
						}

					} else {
						$response->status = REST_Controller::HTTP_BAD_REQUEST;
						$response->status_code = APIResponseCode::BAD_REQUEST;
						$response->msg = 'Invalid Session Id';
						$response->response = NULL;
						$this->response($response, REST_Controller::HTTP_BAD_REQUEST);
					}

				} else {
					$response->status = REST_Controller::HTTP_BAD_REQUEST;
					$response->status_code = APIResponseCode::BAD_REQUEST;
					$response->msg = 'Invalid Clinic Id';
					$response->response = NULL;
					$this->response($response, REST_Controller::HTTP_BAD_REQUEST);
				}

			} else {
				$response->status = REST_Controller::HTTP_UNAUTHORIZED;
				$response->status_code = APIResponseCode::UNAUTHORIZED;
				$response->msg = 'Unauthorized';
				$response->response = NULL;
				$response->error_msg = 'Invalid Authentication Key.';
				$this->response($response, REST_Controller::HTTP_UNAUTHORIZED);
			}

		} else {
			$response->status = REST_Controller::HTTP_METHOD_NOT_ALLOWED;
			$response->status_code = APIResponseCode::METHOD_NOT_ALLOWED;
			$response->msg = 'Method Not Allowed';
			$response->response = NULL;
			$response->error_msg = 'Invalid Request Method.';
			$this->response($response, REST_Controller::HTTP_METHOD_NOT_ALLOWED);
		}
	}

	public function NextNumber_put($session_id = '', $appointment_id = '')
	{
		$method = $_SERVER['REQUEST_METHOD'];
		$response = new stdClass();

		if ($method == 'PUT') {

			$check_auth_client = $this->mmodel->check_auth_client();

			if ($check_auth_client == true) {

				if ($this->mclinicsession->valid_session($session_id)) {

					if ($this->mclinicappointment->update_appointment_status($appointment_id, AppointmentStatus::CONSULTED)) {

							$appointment = $this->mclinicappointment->get_next_appointment($session_id);

							if (!is_null($appointment)) {

								$response->status = REST_Controller::HTTP_OK;
								$response->status_code = APIResponseCode::SUCCESS;
								$response->msg = 'Next Appointment Number';
								$response->response = $appointment;
								$this->response($response, REST_Controller::HTTP_OK);

							} else {
								$response->status = REST_Controller::HTTP_OK;
								$response->status_code = APIResponseCode::SUCCESS;
								$response->msg = 'No Appointments for today';
								$response->response = NULL;
								$this->response($response, REST_Controller::HTTP_OK);
							}

					} else {
						$response->status = REST_Controller::HTTP_BAD_REQUEST;
						$response->status_code = APIResponseCode::BAD_REQUEST;
						$response->msg = null;
						$response->error_msg = 'Invalid Appointment Number';
						$response->response = NULL;
						$this->response($response, REST_Controller::HTTP_BAD_REQUEST);
					}

				} else {
					$response->status = REST_Controller::HTTP_BAD_REQUEST;
					$response->status_code = APIResponseCode::BAD_REQUEST;
					$response->msg = 'Invalid Session Id';
					$response->response = NULL;
					$this->response($response, REST_Controller::HTTP_BAD_REQUEST);
				}

			} else {
				$response->status = REST_Controller::HTTP_UNAUTHORIZED;
				$response->status_code = APIResponseCode::UNAUTHORIZED;
				$response->msg = 'Unauthorized';
				$response->response = NULL;
				$response->error_msg = 'Invalid Authentication Key.';
				$this->response($response, REST_Controller::HTTP_UNAUTHORIZED);
			}

		} else {
			$response->status = REST_Controller::HTTP_METHOD_NOT_ALLOWED;
			$response->status_code = APIResponseCode::METHOD_NOT_ALLOWED;
			$response->msg = 'Method Not Allowed';
			$response->response = NULL;
			$response->error_msg = 'Invalid Request Method.';
			$this->response($response, REST_Controller::HTTP_METHOD_NOT_ALLOWED);
		}
	}

	public function SkipNumber_put($session_id = '', $appointment_id = '')
	{
		$method = $_SERVER['REQUEST_METHOD'];
		$response = new stdClass();

		if ($method == 'PUT') {

			$check_auth_client = $this->mmodel->check_auth_client();

			if ($check_auth_client == true) {

				if ($this->mclinicsession->valid_session($session_id)) {

					if ($this->mclinicappointment->update_appointment_status($appointment_id, AppointmentStatus::SKIPPED)) {

							$appointment = $this->mclinicappointment->get_next_appointment($session_id);

							if (!is_null($appointment)) {

								$response->status = REST_Controller::HTTP_OK;
								$response->status_code = APIResponseCode::SUCCESS;
								$response->msg = 'Next Appointment Number';
								$response->response = $appointment;
								$this->response($response, REST_Controller::HTTP_OK);

							} else {
								$response->status = REST_Controller::HTTP_OK;
								$response->status_code = APIResponseCode::SUCCESS;
								$response->msg = 'No Appointments for today';
								$response->response = NULL;
								$this->response($response, REST_Controller::HTTP_OK);
							}

					} else {
						$response->status = REST_Controller::HTTP_BAD_REQUEST;
						$response->status_code = APIResponseCode::BAD_REQUEST;
						$response->msg = null;
						$response->error_msg = 'Invalid Appointment Number';
						$response->response = NULL;
						$this->response($response, REST_Controller::HTTP_BAD_REQUEST);
					}

				} else {
					$response->status = REST_Controller::HTTP_BAD_REQUEST;
					$response->status_code = APIResponseCode::BAD_REQUEST;
					$response->msg = 'Invalid Session Id';
					$response->response = NULL;
					$this->response($response, REST_Controller::HTTP_BAD_REQUEST);
				}

			} else {
				$response->status = REST_Controller::HTTP_UNAUTHORIZED;
				$response->status_code = APIResponseCode::UNAUTHORIZED;
				$response->msg = 'Unauthorized';
				$response->response = NULL;
				$response->error_msg = 'Invalid Authentication Key.';
				$this->response($response, REST_Controller::HTTP_UNAUTHORIZED);
			}

		} else {
			$response->status = REST_Controller::HTTP_METHOD_NOT_ALLOWED;
			$response->status_code = APIResponseCode::METHOD_NOT_ALLOWED;
			$response->msg = 'Method Not Allowed';
			$response->response = NULL;
			$response->error_msg = 'Invalid Request Method.';
			$this->response($response, REST_Controller::HTTP_METHOD_NOT_ALLOWED);
		}
	}


	public function send_email_get()
	{
		$config = array(
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_port' => 465, //587
			'smtp_user' => 'mailtemp340@gmail.com',
			'smtp_pass' => 'afisol@123',
			'mailtype' => 'html',
			'charset' => 'iso-8859-1',
			'newline' => "\r\n",
		);
		$this->load->library('email', $config);
		$ci = get_instance();
		$ci->email->initialize($config);

//		$ci->email->from('noreply@smartloan.lk', 'Smartloan.lk');
//		$ci->email->to("info@smartloan.lk");
//		$ci->email->subject("Message From Customer");
//		$ci->email->message("Customer Name ");
//		$ci->email->send();
		$data = null;

		$body = $this->load->view('fogot_password',$data,TRUE);

		$ci->email->from('noreply@smartloan.lk', 'Smartloan.lk');
		$ci->email->to("bbb.navin@gmail.com");
		$ci->email->subject("Feedback");
		$ci->email->message($body);

		var_dump($this->email->send());


//		$this->load->view('fogot_password',$data);
	}


//endregion

}
