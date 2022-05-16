import React, { useState, useEffect } from 'react';
import Axios from "../../Config/axios";
import { useHistory } from 'react-router-dom';
import "./selectlogin.style.css";
import { Form } from 'semantic-ui-react';
import { Button,Spinner } from "react-bootstrap";
import { FormInput, CustomTextArea, CustomButton } from '../../Components/form-input/FormInput';
import Joi from "joi"
import { useValidator } from "react-joi"
import returnUserInfo from '../../helper/returnUserInfo';

function NewCustomer(props) {

    useEffect(() => {
        if (returnUserInfo()) {
            history.push("/customer-information")
        }
    }, [])

    const [loaderIcon, setLoader] = useState(false);
    const [error, setError] = useState();

    const { state, setData, setExplicitField, validate } = useValidator({
        initialData: {
            'name': null,
            'email': null,
            'company': null,
            'address1': null,
            'address2': null,
            'city': null,
            'state': null,
            'zip': null,
            'phone': null,
            'notes': null,
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
            company: Joi.string().required().messages({
                'string.base': `Client Company is a required field.`,
                'string.empty': `Client Company is not allowed to be empty.`
            }),
            address1: Joi.string().required().messages({
                'string.base': `Client Address 1 is a required field.`,
                'string.empty': `Client Address 1 is not allowed to be empty.`
            }),
            city: Joi.string().required().messages({
                'string.base': `Client City is a required field.`,
                'string.empty': `Client City is not allowed to be empty.`
            }),
            state: Joi.string().required().messages({
                'string.base': `Client State is a required field.`,
                'string.empty': `Client State is not allowed to be empty.`
            }),
            zip: Joi.string().required().messages({
                'string.base': `Client Zip is a required field.`,
                'string.empty': `Client Zip is not allowed to be empty.`
            }),
            phone: Joi.string().required().messages({
                'string.base': `Client Phone is a required field.`,
                'string.empty': `Client Phone is not allowed to be empty.`
            }),
        }),
        explicitCheck: {
            name: false,
            email: false,
        },
    });

    const history = useHistory();

    const changeHandler = (e) => {
        setData((old) => ({
            ...old,
            [e.target.name]: e.target.value,
        }))

    }
    const submitHandler = (e) => {

        if (state.$validation_success) {
            Axios.post('/register', state.$data)
                .then(response => {
                    localStorage.setItem("user-info", JSON.stringify(response.data));
                    Axios.defaults.headers.common[
                        "Authorization"
                    ] = `Bearer ${response.data.access_token}`;
                    history.push("/new-customer-information")
                    props.updateUser(JSON.stringify(response.data));
                    setLoader(false);
                })
                .catch(error => {
                    // Error
                    if (error.response.data.errors.email == "The email has already been taken.") {
                        setError({ errorMessage: "The email has already been taken" });
                    } else {
                        setError();
                    }
                    setLoader(false);
                })
                setLoader(true);
        }
    }

    return (
        <div className="mt-5">
            <h1 className="heading-1 text-center">New MRT Customer</h1>
            <div className="row justify-content-center">
                <div className="col-md-6 mt-5">
                    <div className="card form-bg">
                        <p className="mb-4 text-center"><b>Enter Information about the customer</b></p>
                        {
                            error ?
                                <div className="alert alert-danger showerror">
                                    {error.errorMessage}
                                </div>
                                :
                                <>
                                </>
                        }
                        <Form onSubmit={submitHandler}>

                            <FormInput
                                type='text'
                                name='name'
                                onChange={changeHandler}
                                label='Client Name'
                                placeholder='Client Name'
                                autoComplete="off"
                            />
                            {state.$errors.name.map((data) => data.$message).join(",") && (
                                <div className="alert alert-danger showerror">
                                    {state.$errors.name.map((data) => data.$message).join(",")}
                                </div>
                            )}
                            <FormInput
                                type='email'
                                name='email'
                                onChange={changeHandler}
                                label='Client Email'
                                placeholder='Client Email'
                                autoComplete="off"
                            />
                            {state.$errors.email.map((data) => data.$message).join(",") && (
                                <div className="alert alert-danger showerror">
                                    {state.$errors.email.map((data) => data.$message).join(",")}
                                </div>
                            )}

                            <FormInput
                                type='text'
                                name='company'
                                onChange={changeHandler}
                                label='Client Company'
                                placeholder='Client Company'
                                autoComplete="off"
                            />
                            {state.$errors.company.map((data) => data.$message).join(",") && (
                                <div className="alert alert-danger showerror">
                                    {state.$errors.company.map((data) => data.$message).join(",")}
                                </div>
                            )}

                            <FormInput
                                type='text'
                                name='phone'
                                onChange={changeHandler}
                                label='Client Phone'
                                placeholder='Client Phone'
                                autoComplete="off"
                            />
                            {state.$errors.phone.map((data) => data.$message).join(",") && (
                                <div className="alert alert-danger showerror">
                                    {state.$errors.phone.map((data) => data.$message).join(",")}
                                </div>
                            )}

                            <FormInput
                                type='text'
                                name='address1'
                                onChange={changeHandler}
                                label='Client Address 1'
                                placeholder='Client Address 1'
                                autoComplete="off"
                            />
                            {state.$errors.address1.map((data) => data.$message).join(",") && (
                                <div className="alert alert-danger showerror">
                                    {state.$errors.address1.map((data) => data.$message).join(",")}
                                </div>
                            )}

                            <FormInput
                                type='text'
                                name='address2'
                                onChange={changeHandler}
                                label='Client Address 2'
                                placeholder='Client Address 2'
                                autoComplete="off"
                            />

                            <div className="row justify-content-center">
                                <div className="col-md-6">
                                    <FormInput
                                        type='text'
                                        name='city'
                                        onChange={changeHandler}
                                        label='Client City'
                                        placeholder='Client City'
                                        autoComplete="off"
                                    />
                                    {state.$errors.city.map((data) => data.$message).join(",") && (
                                        <div className="alert alert-danger showerror">
                                            {state.$errors.city.map((data) => data.$message).join(",")}
                                        </div>
                                    )}
                                </div>
                                <div className="col-md-6">
                                    <FormInput
                                        type='text'
                                        name='state'
                                        onChange={changeHandler}
                                        label='Client State'
                                        placeholder='Client State'
                                        autoComplete="off"
                                    />
                                    {state.$errors.state.map((data) => data.$message).join(",") && (
                                        <div className="alert alert-danger showerror">
                                            {state.$errors.state.map((data) => data.$message).join(",")}
                                        </div>
                                    )}
                                </div>
                            </div>

                            <div className="row justify-content-center">
                                <div className="col-md-12">
                                    <FormInput
                                        type='text'
                                        name='zip'
                                        onChange={changeHandler}
                                        label='Client Zip'
                                        placeholder='Client Zip'
                                        autoComplete="off"
                                    />
                                    {state.$errors.zip.map((data) => data.$message).join(",") && (
                                        <div className="alert alert-danger showerror">
                                            {state.$errors.zip.map((data) => data.$message).join(",")}
                                        </div>
                                    )}
                                </div>
                            </div>

                            <CustomTextArea
                                name='notes'
                                onChange={changeHandler}
                                label='Notes'
                                placeholder='notes is any...'
                                autoComplete="off"
                            />

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
                                        <CustomButton type='submit' onClick={validate}>SUBMIT</CustomButton>
                                    </>
                            }

                        </Form>
                    </div>
                </div>
            </div>
        </div>
    )
}

export default NewCustomer;