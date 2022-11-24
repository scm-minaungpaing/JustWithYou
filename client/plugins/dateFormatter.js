import dayjs from 'dayjs'
export default {
  /**
   * get full date
   * @param {number} month
   * @returns {string} YYYY/M/D
   */
  getFullDate(month) {
    return new Date(new Date().getFullYear(), month, 1).toLocaleDateString()
  },
  /**
   * get start date of month
   * @param {string} date YYYY/M/D
   * @returns {string} YYYY-MM-DD
   */
  getStratDateOfMonth(date) {
    return dayjs(date).startOf('M').format('YYYY-MM-DD')
  },
  /**
   * get last date of month
   * @param {string} date YYYY/M/D
   * @returns {string} YYYY-MM-DD
   */
  getLastDateOfMonth(date) {
    return dayjs(date).endOf('M').format('YYYY-MM-DD')
  },
  /**
   * get date only
   * @param {string} date YYYY/M/D
   * @returns {number}
   */
  getDate(date) {
    return dayjs(date).get('date')
  },
  /**
   * get day only
   * @param {number} day
   * @param {string} date
   * @returns {number} (Sunday as 0, Saturday as 6)
   */
  getDayOnly(date, day) {
    return dayjs(date).date(day).get('d')
  },
  // getDay(date, day) {
  //   return dayjs(date).date(day).get('d')
  // },
  /**
   * get month only
   * @param {number} day
   * @returns {number} (January as 0, December as 11)
   *
   */
  getMonthOnly(day) {
    return dayjs().date(day).get('month')
  },
  /**
   * get year only
   * @param {number} day
   * @returns {number}
   */
  getYearOnly(day) {
    return dayjs().date(day).get('year')
  },
}
