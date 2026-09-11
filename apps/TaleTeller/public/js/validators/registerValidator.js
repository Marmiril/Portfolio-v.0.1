export function validateUsername(username) {

    const usernameRegex = /^[a-zA-Z0-9_]{4,20}$/;

    if (!usernameRegex.test(username)) {
        return {
            valid: false,
            error: '4-20 characters: letters, numbers, underscore only'
        };
    }

    return { valid: true };
}

export function validatePassword(password) {
    const length = password.trim().length;

    if (length < 4 || length > 16) {
        return {
            valid: false,
            error: '`Password 4 - 16 characters'
        };
    }

    return { valid: true };
}

export function validateEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!emailRegex.test(email)) {
        return {
            valid: false,
            error: 'Insert a correct mail'
        };
    }

    return { valid: true };
}
