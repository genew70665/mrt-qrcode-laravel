import React from "react";
import "./info.style.css";
import { Link } from 'react-router-dom';
import { CustomButton } from '../../Components/form-input/FormInput';
import returnUserInfo from '../../helper/returnUserInfo';

function NewCustomerInfo() {

    let user = returnUserInfo(true);

    return (

        <div className="mt-5 text-center">
            <h1 className="heading-1">New MRT Customer</h1>
            <div className="row justify-content-center">
                <div className="col-md-6 mt-5">
                    <div className="card text-center form-bg">
                        <h3 className="mb-2">Your unique Account ID is set.</h3>
                        <h4>Account ID: <span className="mrt-id">{user.data.mrt_id}</span></h4>
                        <p className="text-left p1">For Security reasons, we sent this MRT Customer ID and a temporary password to your email id.</p>
                        <p className="text-left p1">Important Information</p>
                        <p className="text-left p1">Please keep this Account ID for your next login</p>
                        <Link to="/scan-sample">
                            <CustomButton type='submit'>SCAN YOUR SAMPLE</CustomButton>
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    )
}

export default NewCustomerInfo;