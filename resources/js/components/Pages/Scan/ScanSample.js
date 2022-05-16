import React, { useState, useEffect, useRef } from "react";
import './scan-sample.style.css';
import QRimage from '../../assets/images/qrcode.gif';
import { Grid } from 'semantic-ui-react';
import DetailsSample from './DetailsSample';
import RecordTable from '../../Components/RecordTable';
import Axios from "../../Config/axios";


function ScanSample() {

    const contentRef = useRef();

    const [data, setData] = useState([]);
    const [sampleCode, setSample] = useState([]);
    const [showTable, setShowtable] = useState(false);
    const [errors, setErrors] = useState({
        samplecode: null,
        equipment: null
    });

    const showTablef = (e) => {
        setShowtable(true);
    }

    useEffect(() => {
        contentRef.current.focus();
        setTimeout(() => {
            // setError();
        }, 3000);
    }, []);
    const [dubicateEntry, setDublicate] = useState({
        samplecodeDublicate: null
    });
    var code = ''
    var reading = false;
    const scanProduct = (e) => {
        if (e.keyCode === 13) {
            if (code.length > 10) {
                addProduct(code);
                code = "";
            }
            if (code.length >= 8) {
                var existingData = JSON.parse(localStorage.getItem("allData"));
                if(existingData)
                {
                    const samplecodeDublicateErr = existingData.filter((el, index) => {
                        return el.samplecode == code;
                    }
                    ).length;
                    if (samplecodeDublicateErr == 1) {
                        setDublicate({ samplecodeDublicate: "Sample Kit is already scanned" })
                    } if (samplecodeDublicateErr == 0) {
                        setDublicate({ samplecodeDublicate: null })
                        addSampel(code)
                        code = "";
                    }

                } else {
                    addSampel(code)
                    code = "";
                }
            }
        } else {
            code += e.key;
        }
        if (!reading) {
            reading = true;
            setTimeout(() => {
                code = "";
                reading = false;
            }, 200);
        }
    };

    const addProduct = async (code) => {
        try {
            const result = await Axios.get(`/qr-code/${code}`);
            if (result.data.data == null) {
                setErrors({'equipment': "Your scanned or entered Equipment is incorrect"})
            } else {
                setErrors({'equipment': null})
                setData(result.data.data);
                setShowtable(false);
            }
        } catch (error) {

        }
    };

    const addSampel = async (code) => {
        try {
            const result = await Axios.get(`/kit-qr-code/${code}`);
            if (result.data.data == null) {
                setErrors({'samplecode': result.data.message});
            } else {
                setErrors({'samplecode': null})
                setSample(result.data.data);
                setShowtable(false);
            }
        } catch (error) {

        }
    };

    const clearProduct = (e) => {
        setData([]);
        setSample([]);
    }

    const options = [
        { value: 'lubricant', label: 'Lubricant' },
        { value: 'coolant', label: 'Coolant' },
    ]

    const renderTable = () => {
        if (showTable) {
            return <RecordTable />;
        } else if (localStorage.getItem("allData")) {
            return <RecordTable />;
        }
        else {
            return <></>;
        }
    }

    const showScanStatus = () => {
        if (sampleCode.id && data.id) {
            return <h3 style={{color: "#00c700"}}>Your Scan is Successfull!</h3>
        }
        if (sampleCode.id) {
            return <h3>Scan Your Equipment</h3>
        }
        else if (data.id) {
            return <h3>Scan Your Sample</h3>
        }
        else {
            return <h3>Scan Your Sample/Equipment</h3>
        }
    }

    return (
        <div ref={contentRef} onKeyDown={scanProduct} tabIndex="1" className="mt-5 text-center">
            <h1 className="heading-1">Scan Your Sample</h1>

            <div className="mt-5 text-center">
                <Grid textAlign='center' columns={3} stackable>
                    <Grid.Row className="section">
                        <Grid.Column>
                            <div className="qr-sec">
                                <h4 className="heading-4 mt-4">Scan Your Kit</h4>
                                <img className="image-style" src={QRimage} alt="QRimage" />
                                {
                                    showScanStatus()
                                }
                            </div>
                        </Grid.Column>
                                <DetailsSample data={data} sampleCode={sampleCode} errors={errors} clearProduct={clearProduct} dubicateEntry={dubicateEntry} addProduct={addProduct} addSampel={addSampel} showTablef={showTablef} />
                    </Grid.Row>
                </Grid>

                {
                    renderTable()
                }
            </div>

        </div>
    )
}

export default ScanSample;
