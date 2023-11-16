import EditorJS from '@editorjs/editorjs';

export default defineNuxtPlugin(() => {
    return {
        provide: {
            EditorJS: EditorJS
        }
    }
})
