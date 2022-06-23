export const months: any = {
    1: 'Январь',
    2: 'Февраль',
    3: 'Март',
    4: 'Апрель',
    5: 'Май',
    6: 'Июнь',
    7: 'Июль',
    8: 'Август',
    9: 'Сентябрь',
    10: 'Октябрь',
    11: 'Ноябрь',
    12: 'Декабрь'
}

const now = new Date().getUTCFullYear()
export const years: number[] = Array(now - (now - 13)).fill('').map((v, idx) => now - idx)

export const taskStatuses: any = {
    'new': 'Передано специалисту',
    'progress': 'В процессе выполнения',
    'complete': 'Выполнено',
    'waiting_answer': 'Ожидается ответ клиента',
    'waiting_payment': 'Ожидается оплата клиента',
    'additional': 'По доп. соглашению',
    'cancel': 'Отложено/отменено'
}

export const taskTypes: any = {
    'consultation': 'Консультация',
    'content': 'Работа по контенту',
    'code': 'Доработка кода',
    'design': 'Дизайн',
    'configure': 'Конфигурирование системы',
    'warranty': 'Гарантийные работы',
    'other': 'Другое'
}
