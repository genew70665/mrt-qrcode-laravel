import React from "react";
import { Form, Button } from "semantic-ui-react";
import "./input.style.css";

const FormInput = ({ type, label, ...otherProps }) => (
    <div>
        <Form.Field>
            <label className="text-left">{label}</label>
            <Form.Input className="mb-4 custon-input" type={type} {...otherProps}/>
        </Form.Field>
    </div>
)

const CustomTextArea = ({ label, ...otherProps }) => (
    <div>
        <Form.Field>
            <label className="text-left">{label}</label>
            <Form.TextArea className="mb-4 custom-textarea" {...otherProps} />
        </Form.Field>
    </div>
)

const CustomButton = ({ children, invertedButton, ...otherProps }) => (
    <div>
        <Form.Field>
            <Button className={` ${invertedButton ? 'inverted-button' : 'custom-button'}`} {...otherProps}>{children}</Button>
        </Form.Field>
    </div>
)

export {FormInput, CustomTextArea, CustomButton}