import React from "react";
import { Grid, Icon } from 'semantic-ui-react';
import './com.style.css';

const Footer = () => (
  <div>
    <Grid columns='equal' className="mt-4 footer" stackable>
      <Grid.Column>
        <div className="pt-2 text-center">&copy; { new Date().getFullYear() } MRT | All right reserved</div>
      </Grid.Column>
      <Grid.Column width={8}>
      </Grid.Column>
      <Grid.Column>
        <div className="pt-2 text-center">
          {/* <Icon className="icon-center footer-icon" link name='facebook' size="large"/>
          <Icon className="icon-center footer-icon" link name='twitter' size="large"/>
          <Icon className="icon-center footer-icon" link name='instagram' size="large"/> */}
        </div>
      </Grid.Column>
    </Grid>
    </div>
  )

  export default Footer;
