import * as yup from 'yup'
export const timelineSchema = yup.object().shape({
    content: yup.string().required(),
    preview_privacy: yup.string().nullable().label('Preview Privacy Status'),
    images: yup.array().nullable()
});