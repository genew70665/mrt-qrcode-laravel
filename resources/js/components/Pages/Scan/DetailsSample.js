import React, { useState, useEffect } from "react";
import './scan-sample.style.css';
import { Form, Grid } from 'semantic-ui-react';
import { FormInput, CustomButton, CustomTextArea } from '../../Components/form-input/FormInput';
import Joi from 'joi-browser';
import returnUserInfo from '../../helper/returnUserInfo';

function DetailsSample(props) {
    const [scanError, setScanError] = useState(null);
    useEffect(() => {
        setUdata({
            'equipmentID': props.data.id,
            'equipment': value == "new" ? randomEquip : props.data.point_id,
            'equipmentSampled': props.data.equipment ? props.data.equipment : udata.equipmentSampled,
            'identifyFluid': props.data.fluid_in_use ? props.data.fluid_in_use : udata.identifyFluid,
            'typeofEquipment': props.data.equipment_type ? props.data.equipment_type : udata.typeofEquipment,
            'sampelId': props.sampleCode.id,
            'samplecode': props.sampleCode.kit,
            'description': props.data.description ? props.data.description : udata.description
        });
        setScanError(props.errors);
    }, [props.data, props.sampleCode]);

    const [randomEquip, setRandomequip] = useState(null);
    let user = returnUserInfo(true);
    const schema = {
        equipmentID: Joi.number(),
        description: Joi.string().required().error(() => {
            return {
                message: 'Please enter Description.',
            };
        }),
        sampelId: Joi.number().required(),
        equipment: Joi.number().required().min(10000000000).max(99999999999).error(() => {
            return {
                message: 'Please enter Equipment (Point ID).',
            };
        }),
        equipmentSampled: Joi.string().required().error(() => {
            return {
                message: 'Please enter Equipment being sampled.',
            };
        }),
        identifyFluid: Joi.string().required().error(() => {
            return {
                message: 'Please enter Fluid in use.',
            };
        }),
        typeofEquipment: Joi.string().required().error(() => {
            return {
                message: 'Please enter Equipment type.',
            };
        }),
        samplecode: Joi.number().required().min(10000000).max(99999999).error(() => {
            return {
                message: 'Please enter Kit ID.',
            };
        }),
    };

    const [udata, setUdata] = useState({
        'equipmentID': props.data.id,
        'equipment': null,
        'equipmentSampled': null,
        'identifyFluid': null,
        'typeofEquipment': null,
        'sampelId': props.sampleCode.id,
        'samplecode': null,
        'description': null,
    });

    const [errors, setErrors] = useState(null);
    var existingData = JSON.parse(localStorage.getItem("allData"));

    const changeHandler = (e) => {

        var key = e.target.name
        var value = e.target.value
        if (key == "samplecode" && existingData) {
            const samplecodeDublicateErr = existingData.filter((el, index) => {
                return el.samplecode == e.target.value;
            }
            ).length;
            if (samplecodeDublicateErr == 1) {
                setDublicate({ samplecodeDublicate: "Sample Kit is already scanned" })
            } if (samplecodeDublicateErr == 0) {
                setDublicate({ samplecodeDublicate: null })
            }
        }
        var newuData = {
            ...udata,
            [key]: value
        }
        setUdata(newuData);
    }

    const [value, setValue] = useState("existing");

    const handleChange = (e, { value }) => {
        setValue(value);
        if (value == "new") {
            var key = "equipment"
            var value = "" + user.data.mrt_id + window.Math.floor((window.Math.random() * 999) + 999);
            var newuDatat = {
                // ...udata,
                'sampelId': props.sampleCode.id,
                'samplecode': props.sampleCode.kit,
                [key]: value
            }
            setUdata(newuDatat)
            setRandomequip(value)
        }
        if (value == "existing") {
            var key = e.target.name
            var value = e.target.value
            var newuData = {
                // ...udata,
                // [key]: value,
                // ['equipment']: null
                'equipmentID': props.data.id,
                'equipment': value == "new" ? randomEquip : props.data.point_id,
                'equipmentSampled': props.data.equipment ? props.data.equipment : udata.equipmentSampled,
                'identifyFluid': props.data.fluid_in_use ? props.data.fluid_in_use : udata.identifyFluid,
                'typeofEquipment': props.data.equipment_type ? props.data.equipment_type : udata.typeofEquipment,
                'sampelId': props.sampleCode.id,
                'samplecode': props.sampleCode.kit,
                'description': props.data.description ? props.data.description : udata.description
            }
            setUdata(newuData)
        }
    }

    const [dubicateEntry, setDublicate] = useState({
        samplecodeDublicate: null
    });

    const submitHandler = async (e) => {
        e.preventDefault;
        var comb =
        {
            'equipmentID': props.data.id,
            'equipment': udata.equipment,
            'equipmentSampled': udata.equipmentSampled,
            'identifyFluid': udata.identifyFluid,
            'typeofEquipment': udata.typeofEquipment,
            'sampelId': props.sampleCode.id,
            'samplecode': udata.samplecode,
            'description': udata.description
        };
        let result = Joi.validate(comb, schema, { abortEarly: false });
        const { error } = result;
        if (!error && dubicateEntry.samplecodeDublicate == null) {
            if (existingData == null) existingData = [];
            localStorage.setItem("data", JSON.stringify(comb));
            existingData.push(comb);
            localStorage.setItem("allData", JSON.stringify(existingData));
            props.showTablef();
            setUdata({
                'equipmentID': props.data.id,
                'equipment': null,
                'equipmentSampled': null,
                'identifyFluid': null,
                'typeofEquipment': null,
                'sampelId': props.sampleCode.id,
                'samplecode': null,
                'description': null,
            });
            setErrors(null);
            props.clearProduct();
            e.target.reset();
            // e.target.description.value = null;
            setValue("existing");
        } else {
            const errorData = {};
            for (let item of error.details) {
                const name = item.path[0];
                const message = item.message;
                errorData[name] = message;
            }
            setErrors(errorData);
            return errorData;
        }
    }

    const addequipment = (e) => {
        var code = e.target.value
        if (code.length == 11) {
            props.addProduct(code);
        }
    }

    const addSamplekId = (e) => {
        var code = e.target.value
        if (code.length == 8) {
            props.addSampel(code);
        }
    }

    return (
        <div className="column">
            <Grid.Column>
                <div className="info-sec">
                    <h4 className="heading-4 mt-4 mb-4 text-left">Confirm and Edit the Equipment Information below</h4>

                    <Form onSubmit={submitHandler} className="form-aling" id="submitForm">

                        <FormInput
                            type='text'
                            label='Scan or Type the Sample Kit ID'
                            name='samplecode'
                            onInput={changeHandler}
                            onChange={addSamplekId}
                            defaultValue={props.sampleCode.kit}
                            disabled={false}
                        />
                        {
                            errors && errors.samplecode ?
                                <div className="alert alert-danger showerror">
                                    {errors.samplecode}
                                </div>
                                : null
                        }
                        {
                            props.errors && props.errors.samplecode ?
                                <div className="alert alert-danger showerror">
                                    {props.errors.samplecode}
                                </div>
                                : null
                        }
                        {
                            dubicateEntry && dubicateEntry.samplecodeDublicate || props.dubicateEntry && props.dubicateEntry.samplecodeDublicate ?
                                <div className="alert alert-danger showerror">
                                    {dubicateEntry.samplecodeDublicate ? dubicateEntry.samplecodeDublicate : props.dubicateEntry.samplecodeDublicate}
                                </div>
                                : null
                        }

                        <Form.Group inline>
                            <Form.Radio
                                label='Scan Equipment Point ID'
                                name='selectEquipment'
                                value='existing'
                                checked={value === 'existing'}
                                onChange={handleChange}
                            />
                            <Form.Radio
                                label='New Equipment'
                                name='selectEquipment'
                                value='new'
                                checked={value === 'new'}
                                onChange={handleChange}
                            />
                        </Form.Group>
                        {
                            value == "existing" ?
                                <>
                                    <FormInput
                                        type='text'
                                        name='equipment'
                                        label='Scan Equipment Point ID'
                                        onChange={changeHandler}
                                        onInput={addequipment}
                                        defaultValue={props.data.point_id}
                                        disabled={false}
                                    />
                                    {
                                        errors && errors.equipment ?
                                            <div className="alert alert-danger showerror">
                                                {errors.equipment}
                                            </div>
                                            : null
                                    }
                                    {
                                        props.errors && props.errors.equipment ?
                                            <div className="alert alert-danger showerror">
                                                {props.errors.equipment}
                                            </div>
                                            : null
                                    }
                                </> : <>

                                </>
                        }

                        <FormInput
                            type='text'
                            name='equipmentSampled'
                            label='Identify equipment being sampled'
                            onInput={changeHandler}
                            value={udata.equipmentSampled || ''}
                        />
                        {
                            errors && errors.equipmentSampled ?
                                <div className="alert alert-danger showerror">
                                    {errors.equipmentSampled}
                                </div>
                                : null
                        }


                        <FormInput
                            type='text'
                            name='identifyFluid'
                            label='Identify the fluid in use'
                            onInput={changeHandler}
                            value={udata.identifyFluid || ''}
                        />
                        {
                            errors && errors.identifyFluid ?
                                <div className="alert alert-danger showerror">
                                    {errors.identifyFluid}
                                </div>
                                : null
                        }


                        <FormInput
                            type='text'
                            name='typeofEquipment'
                            label='Type of Equipment being sampled'
                            onInput={changeHandler}
                            value={udata.typeofEquipment || ''}

                        />
                        {
                            errors && errors.typeofEquipment ?
                                <div className="alert alert-danger showerror">
                                    {errors.typeofEquipment}
                                </div>
                                : null
                        }

                        <CustomTextArea
                            name='description'
                            label='Description'
                            onInput={changeHandler}
                            value={udata.description || ''}
                        />
                        {
                            errors && errors.description ?
                                <div className="alert alert-danger showerror">
                                    {errors.description}
                                </div>
                                : null
                        }

                        <CustomButton type="submit">SAVE</CustomButton>
                    </Form>

                </div>
            </Grid.Column>
        </div>
    )
}

export default DetailsSample;
