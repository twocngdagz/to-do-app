import * as types from './mutation-types'

export default {
  [types.SET_TASKS] (state, tasks) {
    state.tasks = tasks
  },

  [types.TOGGLE_TASK] (state, data) {
    let pos = state.tasks.findIndex(task => task.id === data.id)
    Object.assign(state.tasks[pos], {...data})
  },

  [types.DELETE_TASK] (state, id) {
    let pos = state.tasks.findIndex(task => task.id === id)
    state.tasks.splice(pos, 1)
  },

  [types.ADD_TASK] (state, task) {
    state.tasks.push(task)
  },

  [types.SET_STATS] (state, stats) {
    state.stats = stats
  },
}
