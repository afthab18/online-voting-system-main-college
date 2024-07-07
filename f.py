import face_recognition
import sys

def compare_faces(image_path1, image_path2, threshold=0.45):
    # Load images
    image1 = face_recognition.load_image_file(image_path1)
    image2 = face_recognition.load_image_file(image_path2)

    # Detect face locations and encodings
    face_locations1 = face_recognition.face_locations(image1)
    face_encodings1 = face_recognition.face_encodings(image1, face_locations1)
    if len(face_encodings1) == 0:
        print("No face detected in image 1.")
        return False

    face_locations2 = face_recognition.face_locations(image2)
    face_encodings2 = face_recognition.face_encodings(image2, face_locations2)
    if len(face_encodings2) == 0:
        print("No face detected in image 2.")
        return False

    # Compare face encodings
    for encoding1 in face_encodings1:
        for encoding2 in face_encodings2:
            distance = face_recognition.face_distance([encoding1], encoding2)
            if distance <= threshold:
                return True

    return False

# Retrieve image paths from command-line arguments
if len(sys.argv) != 3:
    print("Usage: python face.py <image1_path> <image2_path>")
    sys.exit(1)

image_path1 = sys.argv[1]
image_path2 = sys.argv[2]

# Set a threshold for face similarity
threshold = 0.45  # Adjust this threshold as per your requirement

# Compare the faces in the images
result = compare_faces(image_path1, image_path2, threshold)
print(result)
