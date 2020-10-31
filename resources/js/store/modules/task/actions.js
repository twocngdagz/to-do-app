import * as types from './mutation-types'

export const fetchTasks = ({ commit, dispatch, state }, data) => {
  return new Promise((resolve, reject) => {
    window.axios.get(`/tasks`).then((response) => {
      commit(types.SET_TASKS, response.data)
      resolve(response)
    }).catch((err) => {
      reject(err)
    })
  })
}

export const addTask = ({ commit, dispatch, state }, data) => {
  return new Promise((resolve, reject) => {
    window.axios.post('/tasks', data).then((response) => {
      commit(types.ADD_TASK, response.data)
      dispatch('fetchStats')
      resolve(response)
    }).catch((err) => {
      reject(err)
    })
  })
}

export const toggleTask = ({ commit, dispatch, state }, task) => {
  return new Promise((resolve, reject) => {
    window.axios.get(`/tasks/${task.id}`).then((response) => {
      commit(types.TOGGLE_TASK, response.data)
      dispatch('fetchStats')
      resolve(response)
    }).catch((err) => {
      reject(err)
    })
  })
}

export const removeTask = ({ commit, dispatch, state }, task) => {
  return new Promise((resolve, reject) => {
    window.axios.delete(`/tasks/${task.id}`).then((response) => {
      commit(types.DELETE_TASK, task.id)
      dispatch('fetchStats')
      resolve(response)
    }).catch((err) => {
      reject(err)
    })
  })
}

export const fetchStats = ({ commit, dispatch, state }, data) => {
  return new Promise((resolve, reject) => {
    window.axios.get(`/stats`).then((response) => {
      commit(types.SET_STATS, response.data)
      resolve(response)
    }).catch((err) => {
      reject(err)
    })
  })
}
