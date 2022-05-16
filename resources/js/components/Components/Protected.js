import React, { useEffect, useState } from 'react';
import { useHistory } from 'react-router-dom';
import returnUserInfo from '../helper/returnUserInfo';

function Protected(props) {
    const [data, setData] = useState();
    let Cmp = props.Cmp;
    const history = useHistory();
    useEffect(() => {
        let user = returnUserInfo(true);
        if (!user) {
            history.push('/existing-customer')
        }
        else {
            setData(user)
        }
    }, [])

    return (
        data ? <Cmp /> : ''
    )
}

export default Protected