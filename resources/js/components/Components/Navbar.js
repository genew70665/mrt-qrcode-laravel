import React from "react";
import { NavDropdown, Navbar, Container, Nav } from "react-bootstrap";
import { Link, useHistory } from 'react-router-dom';
import "./com.style.css";
import Axios from "../Config/axios";
import returnUserInfo from '../helper/returnUserInfo';

function NavBar(props) {

    let user = returnUserInfo(true);
    const history = useHistory();

    const handleLogout = () => {
        Axios.post(`/logout`)
            .then(response => {
                localStorage.clear();
                history.push("/existing-customer");
                props.setUser(null);
            })
            .catch(error => {
            })
    }

    return (
        <Navbar className="nav-bg" expand="lg">
            <Container>

                <Link to='/'><Navbar.Brand>MRT SCANNER</Navbar.Brand></Link>

                {!user ?
                    <>
                    </>
                    :
                    <>
                        <Navbar.Toggle aria-controls="basic-navbar-nav" />
                        <Navbar.Collapse id="basic-navbar-nav" className="justify-content-end">
                            <Nav className="">
                                <NavDropdown className="navbar-head" title={'ACCOUNT ID: ' + user.data.mrt_id} id="basic-nav-dropdown">
                                    <NavDropdown.Item className="nav-dropdown" onClick={handleLogout}>Logout</NavDropdown.Item>
                                </NavDropdown>
                            </Nav>
                        </Navbar.Collapse>
                    </>
                }

            </Container>
        </Navbar>
    );
}

export default NavBar;
