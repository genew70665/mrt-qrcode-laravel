import React, { useState } from "react";
import Axios from "../Config/axios";
import { Table, Icon } from 'semantic-ui-react';
import { useHistory } from 'react-router-dom';
import { Modal, Button, Spinner } from "react-bootstrap";
import "./com.style.css";
import DeleteRecordModal from "./DeleteRecordModal";
import { CustomButton } from './form-input/FormInput';
import returnUserInfo from '../helper/returnUserInfo';

function RecordTable() {

    const [deleteModal, setDeleteModal] = useState(false);
    const [modalShow, setModalShow] = useState(false);
    const [modalDataSubmited, setModalDataSubmited] = useState(false);
    const [item, setItem] = useState();

    const history = useHistory();

    const openDeleteModal = (item) => {
        setItem(item);
        setDeleteModal(true);
    };

    const user = returnUserInfo(true);
    const records = JSON.parse(localStorage.getItem("allData")) ? JSON.parse(localStorage.getItem("allData")) : [] ;
    const [loaderIcon, setLoader] = useState(false);
    const [success, isSubmited] = useState(false);

    const recDatah = records.map((rec, val) => ({
        "point_id": rec.equipment,
        "samplecode": rec.samplecode,
        "kit_id": rec.sampelId,
        "equipment_id": rec.equipmentID,
        "identified_equipment": rec.equipmentSampled,
        "fluid_in_use": rec.identifyFluid,
        "type": rec.typeofEquipment,
        "description": rec.description
    }));

    let recordData = [{
        "user_id": user.data.id,
        "user_account_id": user.data.mrt_id,
        "user_name": user.data.name,
        "address1": user.data.address1,
        "address2": user.data.address2,
        "city": user.data.city,
        "zip": user.data.zip,
        "email": user.data.email,
        "notes": user.data.notes,
        "company": user.data.company,
        "data": recDatah
    }];
    const data1 = recordData[0];

    const sendData = async (data) => {
        try {
            setLoader(true);
            const result = await Axios.post(`/kit/track`, data1);
            isSubmited(true);
            setModalDataSubmited(true);
            localStorage.removeItem("data");
            localStorage.removeItem("allData");
            history.push("/scan-sample");
        } catch (error) {
        }
    }

    const dataSubmited = (e) => {
        history.push("/scan-sample");
    }


    return (
        <div>
            {!success ?
                <>
                    <Table celled selectable striped>
                        <Table.Header>
                            <Table.Row>
                                <Table.HeaderCell>Equipment</Table.HeaderCell>
                                <Table.HeaderCell>Equipment being sampled</Table.HeaderCell>
                                <Table.HeaderCell>Identify the fluid is use</Table.HeaderCell>
                                <Table.HeaderCell>Sample Kit ID</Table.HeaderCell>
                                <Table.HeaderCell>Type of Equipment being sampled</Table.HeaderCell>
                                <Table.HeaderCell>Description</Table.HeaderCell>
                                <Table.HeaderCell></Table.HeaderCell>
                            </Table.Row>
                        </Table.Header>
                        <Table.Body>
                            {
                                records.map((record, value) => (
                                    <Table.Row key={value}>
                                        <Table.Cell>{record.equipment}</Table.Cell>
                                        <Table.Cell>{record.equipmentSampled}</Table.Cell>
                                        <Table.Cell>{record.identifyFluid}</Table.Cell>
                                        <Table.Cell>{record.samplecode}</Table.Cell>
                                        <Table.Cell>{record.typeofEquipment}</Table.Cell>
                                        <Table.Cell>{record.description}</Table.Cell>
                                        <Table.Cell>
                                            <Icon name='trash' size='large' className="cursor"
                                                onClick={() => {
                                                    openDeleteModal(
                                                        value
                                                    );
                                                }} />
                                        </Table.Cell>
                                    </Table.Row>
                                ))}
                        </Table.Body>
                    </Table>
                    <CustomButton type="submit" onClick={() => setModalShow(true)}
                        disabled={records.length > 0 ? false : true}
                    >SUBMIT YOUR DATA TO MRT</CustomButton>


                    <SubmitModal
                        show={modalShow}
                        onHide={() => setModalShow(false)}
                        sendData={sendData}
                        backdrop="static"
                        loaderIcon={loaderIcon}
                    />


                    <DeleteRecordModal
                        show={deleteModal}
                        records={records}
                        onHide={() => setDeleteModal(false)}
                        id={item}
                    />

                    <SuccessModal
                        show={modalDataSubmited}
                        dataSubmited={dataSubmited}
                        onHide={() => setModalDataSubmited(false)}
                    />

                </> :
                <>
                    <h3 className="successMessage">Success! Thanks for submitted the data to MRT.</h3>
                </>
            }

        </div>
    )
}

function SubmitModal(props) {
    return (
        <Modal
            {...props}
            aria-labelledby="contained-modal-title-vcenter"
            centered
        >
            <Modal.Header closeButton>
                <Modal.Title id="contained-modal-title-vcenter">
                    Submit your Data to MRT
                </Modal.Title>
            </Modal.Header>
            <Modal.Body>
                <h4>Are you sure you want to Submit Data?</h4>
            </Modal.Body>
            <Modal.Footer>
                {props.loaderIcon ?
                    <>
                        <Button className="dataSubmit" style={{ cursor: "not-allowed" }}> <Spinner
                            as="span"
                            variant="light"
                            size="sm"
                            role="status"
                            aria-hidden="true"
                            variant="dark"
                            animation="border" /> Loading..</Button>
                    </> :
                    <>
                        <Button variant="secondary" onClick={props.onHide}>Close</Button>
                        <Button className="dataSubmit" onClick={props.sendData}>  Submit</Button>
                    </>
                }
            </Modal.Footer>
        </Modal>
    );
}

function SuccessModal(props){
    return (
        <Modal
            {...props}
            aria-labelledby="contained-modal-title-vcenter"
            centered
        >
            <Modal.Header>
                <Modal.Title id="contained-modal-title-vcenter">
                    Success!
                </Modal.Title>
            </Modal.Header>
            <Modal.Body>
                <h4>Thanks for submitting the records.</h4>
            </Modal.Body>
            <Modal.Footer>
                <Button className="dataSubmit" onClick={props.dataSubmited}>Done</Button>
            </Modal.Footer>
        </Modal>
    )
}

export default RecordTable;
