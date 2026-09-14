const ERRORS = {
    1: 'Fragment must contain 150-600 words.',
    2: 'Title must exists.',
    3: 'Title shall not exceed 10 words.',
    4: 'May theme exists.',
    5: 'Steps must be between 5 and 15.',
    6: 'Keyword must be a single word.'
}

function errorList(code) {
    return {
        valid: false,
        error: ERRORS[code] ?? 'Unknown error'
    };
}

export function validateTaleForm() {

    const form = document.getElementById('taleForm');
    if (!form) { return { valid: false, error: 'Form not found!' }; }

    const isCreateMode = !form.dataset.taleId;

    const fragment = document.getElementById('fragment');
    if (!fragment || fragment.dataset.valid !== 'true') { return errorList(1); }

    if (!isCreateMode) { return { valid: true }; }

    const title = document.getElementById('title');
    if (!title || title.value.trim() === '') { return errorList(2); }

    const titleWords = title.value.trim().split(/\s+/).length;
    if (titleWords > 10) { return errorList(3); }

    const theme = document.getElementById('theme');
    if (!theme || theme.value === '') { return errorList(4); }

    const steps = document.getElementById('steps');
    const stepsValue = parseInt(steps.value, 10);

    if (isNaN(stepsValue) || stepsValue < 5 || stepsValue > 15) { return errorList(5); }

    const keyword = document.getElementById('keyword');
    if (keyword && keyword.value.trim() === '') {
        if (keyword.value.trim().split(/\s+/).length > 1) { return errorList(6); }
    }
    return { valid: true };
}