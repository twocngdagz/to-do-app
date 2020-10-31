<template>
    <li>
        <div class="form-check">
            <label class="form-check-label">
                <input class="checkbox" type="checkbox" :checked="task.is_done" @change="$emit('update', task)"> {{task.description}} <i class="input-helper"></i>
            </label>
        </div>
        <i class="remove mdi mdi-close-circle-outline" @click="$emit('remove', task)"></i>
    </li>
</template>

<script>
    export default {
        props: ['task']
    }
</script>
