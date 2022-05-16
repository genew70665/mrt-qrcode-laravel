import React, { useEffect } from 'react';
import "./selectlogin.style.css";
import { Link, useHistory } from 'react-router-dom';
import { Icon, Grid } from 'semantic-ui-react';
import returnUserInfo from '../../helper/returnUserInfo';

function SelectLogin() {
    
    const history=useHistory();
    
    useEffect( ()=>{
        if(returnUserInfo())
        {
            history.push("/customer-information")
        }
    },[])

    return (
        <div className="mt-5 text-center">
            <h1 className="heading-1">Welcome to MRT</h1>
            <h3 className="mt-3 heading-3">Select your log in process</h3>

            <Grid textAlign='center' columns={3} stackable>
                <Grid.Row className="SelectLogin">
                    <Grid.Column>
                        <div className="inner-col"> 
                        <h4 className="heading-4">New MRT Customer</h4>
                        <Link to="/new-customer">
                            <Icon className="icon-link" link name='arrow alternate circle right' size='huge' />
                        </Link>
                        </div>
                    </Grid.Column>

                    <Grid.Column>
                    <div className="inner-col"> 
                        <h4 className="heading-4">Existing MRT Customer</h4>
                        <Link to="/existing-customer">
                            <Icon className="icon-link" link name='arrow alternate circle right' size='huge' />
                        </Link>
                        </div>
                    </Grid.Column>
                </Grid.Row>
            </Grid>
        </div>
    )

}

export default SelectLogin;