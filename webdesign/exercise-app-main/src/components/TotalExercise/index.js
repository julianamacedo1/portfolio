import React from "react"

export default class TotalExercise extends React.Component {
    constructor(props) {
        super(props)
        this.state = { minutes: 0 }
    }

    totalMin = add => {
        this.setState({ minutes: add.target.value })
    }

    render() {
        return (
            <>
            <p>Enter total minutes spent exercising today:</p>
            <input
                type="number" 
                value={this.state.minutes}
                onChange={this.totalMin}
            ></input>
            <p class="total-time">Total time: {this.state.minutes} minutes</p>   
            </>
        )
    }
    
}