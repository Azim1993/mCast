import * as yup from 'yup'
export const loginSchema = yup.object().shape({
    user: yup.string().required().label('User name Or Email'),
    password: yup.string().required().label('Password')
});

export const registrationSchema = yup.object().shape({
    user_name: yup.string().required().label('User Name'),
    email: yup.string().email().required().label('Email'),
    password: yup.string().required().label('Password'),
    password_confirmation: yup.string().oneOf([yup.ref('password'), null], 'Passwords must match'),
    first_name: yup.string().required().label('First Name'),
    last_name: yup.string().nullable().label('Last Name'),
})