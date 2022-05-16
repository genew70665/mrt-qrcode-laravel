import React, { useState } from "react";
import ReactDOM from 'react-dom';
import { BrowserRouter as Router, Route, Switch } from 'react-router-dom';
import '../../../node_modules/semantic-ui-css/semantic.min.css'
import './assets/css/style.css'

import Protected from './Components/Protected';
import NavBar from './Components/Navbar';
import Footer from './Components/Footer';
import SelectLogin from './Pages/Login/SelectLogin';
import NewCustomer from './Pages/Login/NewCustomer';
import ExistingCustomer from './Pages/Login/ExistingCustomer';
import ScanSample from './Pages/Scan/ScanSample';
import ScanKit from './Pages/Scan/ScanKit';
import PasswordRetrieve from './Pages/Login/PasswordRetrieve';
import NewCustomerInfo from './Pages/Info/NewCustomerInfo';
import CustomerInfo from './Pages/Info/CustomerInfo';
import returnUserInfo from './helper/returnUserInfo';


function App() {

    const [user, setUser] = useState(returnUserInfo());
    const newUser=(user)=>{
        setUser(user)
    }

    return (
        <div>
            <Router>
                <NavBar data={user} setUser={setUser}/>
                <div className="row justify-content-center main-section">
                    <div className="col-md-11">
                        <Switch>
                            <Route exact path='/'>
                                <SelectLogin />
                            </Route>
                            <Route exact path='/new-customer'>
                                <NewCustomer updateUser={newUser} />
                            </Route>
                            <Route exact path='/password-retrieve'>
                                <PasswordRetrieve/>
                            </Route>

                            <Route exact path='/existing-customer'>
                                <ExistingCustomer updateUser={newUser}/>
                            </Route>

                            <Route exact path='/new-customer-information'>
                                <Protected Cmp={NewCustomerInfo}/>
                            </Route>

                            <Route exact path='/customer-information'>
                                <Protected Cmp={CustomerInfo}/>
                            </Route>

                            <Route exact path='/scan-sample'>
                                <Protected Cmp={ScanSample}/>
                            </Route>
                            <Route exact path='/scan-kit'>
                                <Protected Cmp={ScanKit}/>
                            </Route>
                        </Switch>
                    </div>
                </div>
                <Footer />
            </Router>
        </div>
    );
}

export default App;

if (document.getElementById('app')) {
    ReactDOM.render(<App />, document.getElementById('app'));
}
