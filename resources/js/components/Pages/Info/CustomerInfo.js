import React, { useState, useEffect } from 'react';
import "./info.style.css";
import { useHistory } from 'react-router-dom';
import Axios from "../../Config/axios";
import { Form } from 'semantic-ui-react';
import { FormInput, CustomTextArea, CustomButton } from '../../Components/form-input/FormInput';
import Joi from "joi"
import { useValidator } from "react-joi"
import { Modal, Button } from "react-bootstrap";
import returnUserInfo from '../../helper/returnUserInfo';

function CustomerInfo() {
    const history = useHistory();

    let user = returnUserInfo(true);
    let [passwordStatus, setPasswordStatus] = useState(JSON.parse(localStorage.getItem('passwordStatus')));

    let status = user.message;
    const [fdata, setfData] = useState({});
    const [buttontext, setButtontext] = useState("SEND PASSWORD ON EMAIL");

    const [modalShow, setModalShow] = useState(false);
    const { state, setData, validate } = useValidator({
        initialData: {
            'name': user.data.name,
            'email': user.data.email,
            'notes': user.data.notes,
        },
        schema: Joi.object({
            name: Joi.string().required().messages({
                'string.base': `Client Name is a required field.`,
                'string.empty': `Client Name is not allowed to be empty.`
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

    

    // const [data, setData] = useState();
    const [error, setError] = useState();

    const changeHandler = (e) => {
        setData((old) => ({
            ...old,
            [e.target.name]: e.target.value,
        }))
    }

    useEffect(() => {
        if (state.$data.email == user.data.email) {
            setfData({
                'name': state.$data.name,
                'email': state.$data.email,
                'notes': state.$data.notes
            });
        } else {
            setfData({
                'name': state.$data.name,
                'email': state.$data.email,
                'notes': state.$data.notes
            });
        }
        passwordStatus ? setModalShow(true) : setModalShow(false)
    }, [state.$data]);

    const UpdateUser = (e) => {

        if (state.$validation_success) {
            setButtontext("SENDING...");
            Axios.put(`/update/${user.data.id}`, fdata)
                .then(response => {
                    if (status) {
                        setModalShow(true);
                        localStorage.setItem("passwordStatus", true);
                    } else {
                        user.data['name'] = response.data.data.name;
                        user.data['email'] = response.data.data.email;
                        user.data['notes'] = response.data.data.notes;
                        localStorage.setItem("user-info", JSON.stringify(user));
                        history.push("/scan-sample");
                    }
                })
                .catch(error => {
                    // Error
                    if (error.response.data.errors.email == "The email has already been taken.") {
                        setError({ errorMessage: "The email has already been taken" });
                        setButtontext("SEND PASSWORD ON EMAIL");
                    }
                })
        }
    }

    const logoutUser = (e) => {
            localStorage.clear();
            history.push("/existing-customer");
    }

    return (
        <div className="mt-5">
            <h1 className="heading-1 text-center">Customer Information</h1>
            <div className="row justify-content-center">
                <div className="col-md-6 mt-5">
                    <div className="card form-bg">
                        <h3 className="mb-2 text-center">Enter Information about the customer</h3>
                        {
                            error ?
                                <div className="alert alert-danger showerrorMsg">
                                    {error.errorMessage}
                                </div>
                                :
                                <>
                                </>
                        }
                        <Form onSubmit={UpdateUser}>

                            <FormInput
                                type='text'
                                name='name'
                                defaultValue={user.data.name}
                                onChange={changeHandler}
                                label='Client Name'
                                placeholder='Client Name'
                            />
                            {state.$errors.name.map((data) => data.$message).join(",") && (
                                <div className="alert alert-danger showerror">
                                    {state.$errors.name.map((data) => data.$message).join(",")}
                                </div>
                            )}

                            <FormInput
                                type='email'
                                name='email'
                                defaultValue={user.data.email}
                                onChange={changeHandler}
                                label='Client Email'
                                placeholder='Client Email'
                            />
                            {state.$errors.email.map((data) => data.$message).join(",") && (
                                <div className="alert alert-danger showerror">
                                    {state.$errors.email.map((data) => data.$message).join(",")}
                                </div>
                            )}

                            <CustomTextArea
                                name='notes'
                                label='Notes'
                                defaultValue={user.data.notes}
                                onChange={changeHandler}
                                placeholder='notes is any...'
                            />

                            <CustomButton type='submit' onClick={validate} 
                            disabled={buttontext == "SENDING..." ? true : false}
                            >{status ? buttontext : "SCAN THE KIT" }</CustomButton>

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
                <h4>Successfull- Your password is sent on your email.</h4>
            </Modal.Body>
            <Modal.Footer>
                <Button variant="secondary" onClick={props.function}>DONE</Button>
            </Modal.Footer>
        </Modal>
    );
}

export default CustomerInfo;