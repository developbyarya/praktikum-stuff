import turtle

def draw_circle(color, x, y, radius):
    """Draws a filled circle with a given color, position, and radius."""
    turtle.penup()
    turtle.goto(x, y - radius)
    turtle.pendown()
    turtle.color(color)
    turtle.begin_fill()
    turtle.circle(radius)
    turtle.end_fill()

def draw_eye(x, y):
    """Draws an eye with a white sclera and black pupil."""
    draw_circle("white", x, y, 20)  # White part of the eye
    draw_circle("black", x, y, 10)  # Pupil

def draw_angry_eyebrows():
    """Draws slanted eyebrows for an angry expression."""
    turtle.pensize(5)
    
    # Left eyebrow
    turtle.penup()
    turtle.goto(-40, 50)
    turtle.pendown()
    turtle.goto(-10, 80)

    # Right eyebrow
    turtle.penup()
    turtle.goto(40, 50)
    turtle.pendown()
    turtle.goto(10, 80)

def draw_angry_mouth():
    """Draws a frowning mouth to show anger."""
    turtle.pensize(5)
    turtle.penup()
    turtle.goto(-40, -30)
    turtle.pendown()
    turtle.setheading(-60)
    turtle.circle(40, 120)  # Draws a frown

def draw_text():
    """Writes 'Aku Marah' below the emoji."""
    turtle.penup()
    turtle.goto(-40, -100)
    turtle.color("black")
    turtle.write("Aku Marah", font=("Arial", 20, "bold"))

def draw_mad_emoji():
    """Combines all parts to create the mad emoji."""
    turtle.speed(3)
    draw_circle("yellow", 0, 0, 100)  # Face
    draw_eye(-30, 40)  # Left eye
    draw_eye(30, 40)  # Right eye
    draw_angry_eyebrows()  # Eyebrows
    draw_angry_mouth()  # Mouth
    draw_text()  # Text below the emoji
    turtle.hideturtle()
    turtle.done()

draw_mad_emoji()
