import React from "react";
import { Modal, Button } from "react-bootstrap";

function DeleteRecordModal(props) {
    
    const deleteRecord = async (e) => {
        try {
            let allData = Object.values(props.records);
            var newData=allData.filter((el,index)=>
                index!=props.id
            )
            props.onHide();
            localStorage.setItem('allData', JSON.stringify(newData));
        } catch (error) {
            props.onHide();
        }
    };

    return (
        <>
            <Modal
                aria-labelledby="contained-modal-title-vcenter"
                centered
                show={props.show}
                onHide={props.onHide}
            >
                <Modal.Header closeButton>
                    <Modal.Title>Delete Record</Modal.Title>
                </Modal.Header>
                <Modal.Body>
                    Are you sure you want to Delete this Record?
                </Modal.Body>
                <Modal.Footer>
                    <Button variant="secondary" onClick={props.onHide}>
                        Close
                    </Button>
                    <Button className="dataSubmit btn btn-primary" onClick={deleteRecord}>
                        Delete
                    </Button>
                </Modal.Footer>
            </Modal>
        </>
    )
}

export default DeleteRecordModal;