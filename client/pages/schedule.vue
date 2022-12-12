<template>
  <div class="schedule">
    <h1>Schedule</h1>
    <div class="month-box">
      <b-form-select
        v-model="selected_month"
        @input="changeMonth(getFullDate)"
      >
        <option
          v-for="(option, index) in months"
          :key="index"
          :value="option.order"
        >
          {{option.name}}
        </option>
      </b-form-select>
    </div>
    <div class="date-box">
      <b-form-datepicker
        v-model="start_date"
        :date-format-options="{ year: 'numeric' }"
        locale="en"
        class="start-date"
        @input="changeDate(start_date, end_date)"
      />

      <b-form-datepicker
        v-model="end_date"
        :date-format-options="{ year: 'numeric' }"
        locale="en"
        class="end-date"
        @input="changeDate(start_date, end_date)"
      />
    </div>
    <div v-if="date_items.length != 0">
      <div
        class="day_box"
      >
        <ul class="list">
          <li
            v-for="(item, index) in date_items"
            :key="index"
            :class="setColor(item.date.type)"
            v-text="item.date.day"
            @click="changeColor(index)"
          />
        </ul>
      </div>
      <div class="time_box">
        <div class="holiday">
          <time-box
            v-if="hodlidayTimes.length != 0"
            :times='hodlidayTimes'
            @edit="editTime($event)"
          />
          <b-button
            class="holiday_btn"
            variant="primary"
            @click="openModal(0)"
          >
            <i class="fa fa-plus"></i>
          </b-button>
        </div>
        <div class="normal">
          <time-box
            v-if="normalTimes.length != 0"
            :times='normalTimes'
            @edit="editTime($event)"
          />
          <b-button
            class="normal_btn"
            variant="primary"
            @click="openModal(1)"
          >
            <i class="fa fa-plus"></i>
          </b-button>
        </div>
      </div>
      <div class="button_group">
        <button
          @click="cancelSchedule"
        >Cancel</button>
        <button
          @click="saveSchedule"
          :disabled="hodlidayTimes.length == 0 && normalTimes.length == 0"
        >Save</button>
      </div>
      <add-schedule-modal
        :modal-text="title"
        ref="timeScheduleModal"
        @save="setTime($event)"
      />
    </div>
  </div>
</template>

<script>
import { mapActions } from "vuex";
import dateFormatter from '@/plugins/dateFormatter'
import TimeBox from '@/components/timeBox.vue'
import AddScheduleModal from '@/components/scheduleModal.vue'
export default {
  layout: "adminLayout",
  components: {
    TimeBox,
    AddScheduleModal
  },
  data() {
    return {
      selected_month: new Date().getMonth(),
      months: [
        { order: 0, name: 'January' },
        { order: 1, name: 'February' },
        { order: 2, name: 'March' },
        { order: 3, name: 'April' },
        { order: 4, name: 'May' },
        { order: 5, name: 'June' },
        { order: 6, name: 'July' },
        { order: 7, name: 'August' },
        { order: 8, name: 'September' },
        { order: 9, name: 'October' },
        { order: 10, name: 'November' },
        { order: 11, name: 'December' }
      ],
      date_items: [],
      start_date: null,
      end_date: null,
      title: null,
      hodlidayTimes:[],
      normalTimes:[],
      dayType: null,
    }
  },
  computed: {
    /**
     * get the date of selected month
     *
     */
    getFullDate() {
      return dateFormatter.getFullDate(this.selected_month)
    },
  },
  mounted() {
    this.changeMonth(this.getFullDate)
  },
  methods: {
    ...mapActions({
      addSchedule: "schedule/addSchedule",
    }),
    /**
     * get & set month of year
     * @param {string} getFullDate
     *
     */
    changeMonth(getFullDate) {
      this.date_items = []
      this.start_date = dateFormatter.getStratDateOfMonth(getFullDate)
      this.end_date = dateFormatter.getLastDateOfMonth(getFullDate)
      this.changeDate(this.start_date, this.end_date)
    },
    /**
     * get & set date of month
     * @param {string} start_date
     * @param {string} end_date
     *
     */
    changeDate(start_date, end_date) {
      this.date_items = []
      if (start_date && end_date) {
        this.getNumbers(start_date, end_date)
      }
    },
    /**
     * get & set day of month
     * @param {string} start_date
     * @param {string} end_date
     * 0: holiday, 1: normal day, 2: close day
     *
     */
    getNumbers(start_date, end_date) {
      const startDay = dateFormatter.getDate(start_date)
      const endDay = dateFormatter.getDate(end_date)
      for (let i = startDay; i <= endDay; i++) {
        this.date_items.push({
          year: dateFormatter.getYearOnly(i),
          month: dateFormatter.getMonthOnly(i) + 1,
          date:{
            day: i,
            type: (
                dateFormatter.getDayOnly(start_date, i) === 6 || dateFormatter.getDayOnly(start_date, i) === 0
              ) ? 2 : 0,
            schedule_times: []
          }
        })
      }
    },
    /**
     * set color of day
     * @param {number} type
     * 0: holiday, 1: normal day, 2: close day
     *
     */
    setColor(type) {
      if (type === 2) return "weekend-color"
      const color = (type === 0) ? "initial-color" : "yellow-color"
      return color
    },
    /**
     * change color of day
     * @param {number} index
     * 0: holiday, 1: normal day, 2: close day
     *
     */
    changeColor(index) {
      if (this.date_items[index].date.type === 2) return

      this.date_items[index].date.type = (
          this.date_items[index].date.type === 0
        )
        ? 1 : 0
    },
    /**
     * open schedule time modal
     * @param {number} type
     * 0: holiday, 1: normal day
     *
     */
    openModal(type) {
      this.dayType = type
      this.title = (type === 0 ) ? "Holiday Time Schedule" : "Normal Day Time Schedule"
      this.$refs.timeScheduleModal.showModal()
    },
    /**
     * set schedule time
     * @param {object} data
     *
     */
    setTime(data) {
      (this.dayType === 0) ? this.setHolidayTime(data) : this.setNormalTime(data)
    },
    /**
     * set schedule time of holiday
     * @param {object} data
     *
     */
    setHolidayTime(data) {
      if (data.startTime === null) data.startTime = 0
      if (data.endTime === null) data.endTime = 0
      this.hodlidayTimes.push(data)
    },
    /**
     * set schedule time of normal day
     * @param {object} data
     *
     */
    setNormalTime(data) {
      if (data.startTime === null) data.startTime = 0
      if (data.endTime === null) data.endTime = 0
      this.normalTimes.push(data)
    },
    /**
     * edit schedule time
     * @param {object} time
     *
     */
    editTime(time) {
      this.$refs.timeScheduleModal.editSchedule(time)
    },
    /**
     * save schedule dateTime
     *
     */
    async saveSchedule() {
      this.date_items.forEach(item => {
        if (item.date.type !== 2) {
          (item.date.type === 0) ?
          item.date.schedule_times = this.normalTimes :
          item.date.schedule_times = this.hodlidayTimes
        }
      });
      const res = await this.addSchedule(this.date_items)
      console.log('res', res)
      console.log('this.date_items', this.date_items)
      if (res.status === 200) {
        this.cancelSchedule()
      }
    },
    /**
     * cancel schedule time
     *
     */
    cancelSchedule() {
      this.hodlidayTimes = []
      this.normalTimes = []
      this.dayType = null
    },
  }
}
</script>

<style lang="scss" scoped>
  .schedule {
    width: 401px;
    margin: 0 auto;
    .date-box {
      display: flex;
      justify-content: space-between;
      margin-top: 10px;
      .start-date {
        margin-right: 10px;
      }
    }
    .day_box {
      margin-top: 10px;
      padding: 0 0 10px 10px;
      border: 1px solid rgb(162, 162, 162);
      ul {
        &.list {
          list-style-type: none;
          padding: 0;
          margin: 0;
          display: flex;
          flex-wrap: wrap;
          li {
            width:50px;
            text-align:center;
            margin: 10px 5px 0 0;
            padding: 10px 15px 10px 15px;
            border-radius:.625rem;
            &.initial-color {
              background-color: #ebe4e4;
            }
            &.yellow-color {
              background-color: #fdac19;
            }
            &.weekend-color {
              background-color: #cb5c47;
            }
          }
        }
      }
    }
    .time_box {
      margin-top: 10px;
      padding: 10px 5px;
      border: 1px solid rgb(162, 162, 162);
      display: flex;
      justify-content: space-between;
      .holiday {
        width: 49%;
        .holiday_btn {
          float: right;
        }
      }
      .normal {
        width: 49%;
        .normal_btn {
          float: right;
        }
      }
    }
    .button_group {
      margin-top: 10px;
    }
  }
</style>
