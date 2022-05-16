import React from "react";
import './scan-sample.style.css';
import { Link } from 'react-router-dom';
import { Icon, Grid } from 'semantic-ui-react';

function ScanKit() {

    return (
        <div className="mt-5 text-center">
            <h1 className="heading-1">Scan The Kit</h1>

            <Grid textAlign='center' columns={3} stackable>
                <Grid.Row className="SelectLogin">
                    <Grid.Column>
                        <div className="inner-col">
                            <h4 className="heading-4">New Sample Kit</h4>
                            <Link to="/scan-sample">
                                <Icon className="icon-center" link name='arrow alternate circle right' size='huge' />
                            </Link>
                        </div>
                    </Grid.Column>

                    <Grid.Column>
                        <div className="inner-col">
                            <h4 className="heading-4">Existing Equipment</h4>
                            <Link to="/existing-equipment">
                                <Icon className="icon-center" link name='arrow alternate circle right' size='huge' />
                            </Link>
                        </div>
                    </Grid.Column>
                </Grid.Row>
            </Grid>

        </div>
    )

}

export default ScanKit;