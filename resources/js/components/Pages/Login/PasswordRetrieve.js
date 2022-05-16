import React, { useState } from 'react';
import Axios from "../../Config/axios";
import { useHistory } from 'react-router-dom';
import "./selectlogin.style.css";
import { Form } from 'semantic-ui-react';
import { FormInput, CustomButton } from '../../Components/form-input/FormInput';
import Joi from "joi"
import { useValidator } from "react-joi"
import { Modal, Button,Spinner } from "react-bootstrap";

function PasswordRetrieve() {

    const [error, setError] = useState(null);
    const [modalShow, setModalShow] = useState(false);
    const [loaderIcon, setLoader] = useState(false);
    const history = useHistory();

    const { state, setData, validate } = useValidator({
        initialData: {
            'mrtId': null,
            'email': null,
        },
        schema: Joi.object({
            mrtId: Joi.number().required().min(1000000).max(9999999).messages({
                'number.base': `Please enter Account ID.`,
                'number.empty': `Account ID is not allowed to be empty.`,
                'number.min': `Account ID must be equal to 7-digit.`,
                'number.max': `Account ID must be equal to 7-digit.`
            }),
            email: Joi.string()
                .email({
                    tlds: { allow: false },
                })
                .required().messages({
                    'string.base': `Client Email is a required field.`,
                    'string.email': `Client Email must be a valid email.`,
                    'string.empty': `Client Email is not allowed to be empty.`
                }),
        }),
    });

    const changeHandler = (e) => {
        setData((old) => ({
            ...old,
            [e.target.name]: e.target.value,
        }));
        setError(null);
    }

    const ResetPassword = (e) => {
        let fdata = [{
            'mrtId': state.$data.mrtId,
            'email': state.$data.email,
        }];
        if (state.$validation_success) {
            Axios.post(`/password-reset`, fdata[0])
                .then(response => {
                    if (response.data.status == false) {
                        setError({ errorMessage: response.data.message });
                        setLoader(false);
                    } else {
                        setModalShow(true);
                    }
                });
            setLoader(true);
        }
    }

    const logoutUser = (e) => {
        history.push("/existing-customer");
    }

    return (
        <div className="mt-5">
            <h1 className="heading-1 text-center">Forget Password</h1>
            <div className="row justify-content-center">
                <div className="col-md-6 mt-5">
                    <div className="card form-bg">
                        <h3 className="mb-2 text-center">Enter Information</h3>
                        {
                            error ?
                                <div className="alert alert-danger showerrorMsg">
                                    {error.errorMessage}
                                </div>
                                :
                                <>
                                </>
                        }
                        <Form onSubmit={ResetPassword}>

                            <FormInput
                                type='text'
                                name='mrtId'
                                onChange={changeHandler}
                                label='Enter 7-digit Account ID'
                                placeholder='1234567'
                                autoComplete="off"
                            />
                            {state.$errors.mrtId.map((data) => data.$message).join(",") && (
                                <div className="alert alert-danger showerror">
                                    {state.$errors.mrtId.map((data) => data.$message).join(",")}
                                </div>
                            )}

                            <FormInput
                                type='email'
                                name='email'
                                onChange={changeHandler}
                                label='Client Email'
                                placeholder='Client Email'
                            />
                            {state.$errors.email.map((data) => data.$message).join(",") && (
                                <div className="alert alert-danger showerror">
                                    {state.$errors.email.map((data) => data.$message).join(",")}
                                </div>
                            )}

                            {
                                loaderIcon ?
                                    <>
                                        <CustomButton style={{ cursor: "not-allowed" }}> <Spinner
                                            as="span"
                                            variant="light"
                                            size="sm"
                                            role="status"
                                            aria-hidden="true"
                                            variant="dark"
                                            animation="border" /> Loading..</CustomButton>
                                    </> :
                                    <>
                                        <CustomButton type='submit' onClick={validate} >PASSWORD RESET</CustomButton>
                                    </>
                            }

                        </Form>
                    </div>
                </div>
                <AlertModal
                    show={modalShow}
                    function={logoutUser}
                    backdrop="static"
                />
            </div>
        </div>
    )
}

function AlertModal(props) {
    return (
        <Modal
            {...props}
            aria-labelledby="contained-modal-title-vcenter"
            centered
        >
            <Modal.Body>
                <h4>Successfull - Your password is sent on your email.</h4>
            </Modal.Body>
            <Modal.Footer>
                <Button variant="secondary" onClick={props.function}>DONE</Button>
            </Modal.Footer>
        </Modal>
    );
}

export default PasswordRetrieve;
