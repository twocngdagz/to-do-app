<template>
    <div class="card px-3">
        <div class="card-body">
            <chart :chartdata="stats"></chart>
            <h4 class="card-title">My To Do</h4>
            <div class="add-items d-flex">
                <input type="text" class="form-control todo-list-input" placeholder="What do you need to do today?" v-model="task" ref="input">
                <button class="add btn btn-primary font-weight-bold todo-list-add-btn" @click="add">Add</button>
            </div>
            <div class="list-wrapper">
                <ul class="d-flex flex-column-reverse todo-list">
                    <to-do-item
                        v-for="(task, index) in tasks"
                        :key="index"
                        :class="{completed: task.is_done}"
                        :task.sync="task"
                        @remove="removeTask"
                        @update="toggleTask"
                    >
                    </to-do-item>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapActions, mapGetters } from 'vuex'

    export default {
        data() {
            return {
                task: "",
            }
        },
        computed: {
            ...mapGetters('task', [
                'tasks',
                'stats'
            ])
        },
        methods: {
            ...mapActions('task', [
                'fetchTasks',
                'addTask',
                'toggleTask',
                'removeTask',
                'fetchStats'
            ]),
            add() {
                if (this.task != "") {
                    this.addTask({
                        task: this.task
                    })
                    this.task = ""
                    this.$refs.input.focus()
                }
            },
        },
        created() {
            this.fetchTasks()
            this.fetchStats()
        }
    }
</script>
