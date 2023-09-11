import axios from 'axios';
const ServiceApi = axios.create({
  baseURL: process.env.API_URL || 'http://localhost:81/api/v1/',
  withCredentials: false,
  headers: {
    Authorization: process.client ? localStorage.getItem('auth._token.local'): ''
  }
})
export default  {
  async get(url, params = {}) {
    try {
      const { data } = await ServiceApi.get(url, { params });
      return data;
    } catch (error) {
      console.log(error)
    }
  },

  async put(url, prams) {
    try {
      const { data } = await ServiceApi.put( url, prams);
      return data;
    } catch (error) {
      console.log(error)
    }
  },

  async patch(url, prams) {
    try {
      const { data } = await ServiceApi.patch(url, prams);
      return data;
    } catch (error) {
      console.log(error)
    }
  },

  async post(url, prams) {
    try {
      const { data } = await ServiceApi.post(url, prams);
      return data;
    } catch (error) {
      console.log(error)
    }
  },

  async delete(url, prams) {
    try {
      const { data } = await ServiceApi.delete(url, prams);
      return data;
    } catch (error) {
      console.log(error)
    }
  }
}


