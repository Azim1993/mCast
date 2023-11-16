export type loginParamsType = {
    user: string,
    password: string
}

export type registerParamsType = {
    user_name: string,
    email: string,
    password: string,
    password_confirmation: string,
    first_name: string,
    last_name?: string,
}

export interface UserInfo {
    id: BigInt,
    first_name: string,
    last_name?: string,
    user_name?: string,
    email?: string,
    profile_pic?: string,
}