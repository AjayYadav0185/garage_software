@extends('user.dashboard.layout.master')
@section('user-contant')
    <!-- Include D3.js library -->
    <script src="https://d3js.org/d3.v7.min.js"></script>


    <h1>D3.js Graph in Laravel Blade</h1>

    <!-- Your graph container -->
    <div id="graph-container" style="width: 500px; height: 300px;"></div>

    <!-- Your D3.js code -->
    <script>
        // Sample data
        const data = [10, 20, 30, 40, 50];

        // Create SVG element
        const svg = d3.select("#graph-container")
            .append("svg")
            .attr("width", 500)
            .attr("height", 300);

        // Create bars
        svg.selectAll("rect")
            .data(data)
            .enter()
            .append("rect")
            .attr("x", (d, i) => i * 70)
            .attr("y", (d) => 300 - d * 5)
            .attr("width", 65)
            .attr("height", (d) => d * 5)
            .attr("fill", "teal");

        // Create labels
        svg.selectAll("text")
            .data(data)
            .enter()
            .append("text")
            .text((d) => d)
            .attr("x", (d, i) => i * 70 + 30)
            .attr("y", (d) => 300 - d * 5 - 5)
            .attr("font-family", "sans-serif")
            .attr("font-size", "20px")
            .attr("fill", "white")
            .attr("text-anchor", "middle");
    </script>
@endsection
