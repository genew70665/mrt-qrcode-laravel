import React, { useState, useEffect } from 'react';
import Axios from "../../Config/axios";
import showPwdImg from '../../assets/images/show-password.svg';
import hidePwdImg from '../../assets/images/hide-password.svg';
import { useHistory, Link  } from 'react-router-dom';
import "./selectlogin.style.css";
import { Form } from 'semantic-ui-react';
import { FormInput, CustomButton } from '../../Components/form-input/FormInput';
import Joi from "joi"
import { useValidator } from "react-joi"
import returnUserInfo from '../../helper/returnUserInfo';

function ExistingCustomer(props) {

    useEffect(() => {
        if (returnUserInfo()) {
            history.push("/customer-information")
        }
    }, [])

    const [isRevealPwd, setIsRevealPwd] = useState(false);

    const { state, setData, validate } = useValidator({
        initialData: {
            'mrt_id': null,
            'password': null,
        },
        schema: Joi.object({
            mrt_id: Joi.number().required().min(1000000).max(9999999).messages({
                'number.base': `Account ID must be a number.`,
                'number.empty': `Account ID is not allowed to be empty.`,
                'number.min': `Account ID must be equal to 7-digit.`,
                'number.max': `Account ID must be equal to 7-digit.`
            }),
        }),
        explicitCheck: {
            mrt_id: false,
            password: false,
        },
    });

    const [error, setError] = useState();

    const history = useHistory();

    const changeHandler = (e) => {
        setData((old) => ({
            ...old,
            [e.target.name]: e.target.value,
        }))
    }

    const CustomerLogin = (e) => {

        if (state.$validation_success) {
            setError();
            Axios.post('/login', state.$data)
                .then(response => {
                    localStorage.setItem("user-info", JSON.stringify(response.data));
                    Axios.defaults.headers.common[
                        "Authorization"
                    ] = `Bearer ${response.data.access_token}`;
                    history.push("/customer-information");
                    props.updateUser(JSON.stringify(response.data));
                })
                .catch(error => {
                    // Error
                    // console.log(error.response.data.message);
                    if (error.response.data.code == 3) {
                        setError({ errorMessage: "Invalid credentials." });
                    }
                    else if (error.response.data.code == 1) {
                        setError({ errorMessage: error.response.data.message });
                    }
                    else if (error.response.data.code == 2) {
                        setError({ errorMessage: "Please enter your password." });
                    }
                    else {
                        setError();
                    }
                })
        }
    }

    return (

        <div className="mt-5">
            <h1 className="heading-1 text-center">Existing MRT Customer</h1>
            <div className="row justify-content-center">
                <div className="col-md-6 mt-5">
                    <div className="card form-bg">
                        <p className="mb-4 text-center"><b>Welcome to MRT</b></p>
                        <Form onSubmit={CustomerLogin}>

                            <FormInput
                                type='text'
                                name='mrt_id'
                                onChange={changeHandler}
                                label='Enter 7-digit Account ID'
                                placeholder='1234567'
                                autoComplete="off"
                            />
                            {state.$errors.mrt_id.map((data) => data.$message).join(",") && (
                                <div className="alert alert-danger showerror">
                                    {state.$errors.mrt_id.map((data) => data.$message).join(",")}
                                </div>
                            )}

                            {
                                error ?
                                    error.errorMessage == "Please enter a valid Account ID." ?
                                    <>
                                        <div className="alert alert-danger showerror">
                                            {error.errorMessage}
                                        </div>
                                        </>
                                        :
                                        <>
                                        </>
                                    :
                                    <>
                                    </>
                            }

                            {
                                error ?
                                    error.errorMessage == "Please enter your password." || error.errorMessage == "Invalid credentials." ?
                                        <>
                                            <FormInput
                                                // type='password'
                                                type={isRevealPwd ? "text" : "password"}
                                                name='password'
                                                onChange={changeHandler}
                                                label='Enter Password'
                                                placeholder='***********'
                                                autoComplete="off"
                                            />
                                            <img className='pwdImg' title={isRevealPwd ? "Hide password" : "Show password"}
                                            src={isRevealPwd ? hidePwdImg : showPwdImg}
                                            onClick={() => setIsRevealPwd(prevState => !prevState)}
                                             />
                                        </>
                                        : <> </>

                                    :
                                    <>
                                    </>
                            }

                            {
                                error ?
                                    error.errorMessage == "Please enter your password." || error.errorMessage == "Invalid credentials." ?
                                        <>
                                            <div className="alert alert-danger showerror">
                                                {error.errorMessage}
                                            </div>
                                        </>
                                        : <> </>
                                    :
                                    <>
                                    </>
                            }

                            <div className='password-retrieve'>
                                <Link to='/password-retrieve'>Forget Password ?</Link>
                            </div>
                            <CustomButton type='submit' onClick={validate}>LOGIN</CustomButton>
                        </Form>
                    </div>
                </div>
            </div>
        </div>
    )

}

export default ExistingCustomer;
