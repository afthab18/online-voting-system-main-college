import cv2
import sys

def compare_fingerprints(image1_path, image2_path):
    # Load the fingerprint images
    fingerprint_image1 = cv2.imread(image1_path, cv2.IMREAD_GRAYSCALE)
    fingerprint_image2 = cv2.imread(image2_path, cv2.IMREAD_GRAYSCALE)

    # Create a SIFT (Scale-Invariant Feature Transform) recognizer object
    recognizer = cv2.SIFT_create()

    # Detect keypoints and descriptors for both fingerprint images
    keypoints1, descriptors1 = recognizer.detectAndCompute(fingerprint_image1, None)
    keypoints2, descriptors2 = recognizer.detectAndCompute(fingerprint_image2, None)

    # Match descriptors using FLANN (Fast Library for Approximate Nearest Neighbors) matcher
    FLANN_INDEX_KDTREE = 1
    index_params = dict(algorithm=FLANN_INDEX_KDTREE, trees=5)
    search_params = dict(checks=50)
    flann = cv2.FlannBasedMatcher(index_params, search_params)
    matches = flann.knnMatch(descriptors1, descriptors2, k=2)

    # Ratio test to find good matches
    good_matches = []
    for m, n in matches:
        if m.distance < 0.7 * n.distance:
            good_matches.append(m)

    # Calculate matching score
    matching_score = len(good_matches) / max(len(keypoints1), len(keypoints2))

    # Define a threshold for matching
    matching_threshold = 0.02

    # Check if matching score exceeds the threshold
    if matching_score > matching_threshold:
        return 1
    else:
        return 0

# Main function to compare two fingerprint images
if __name__ == "__main__":
    # Check if correct number of arguments are provided
    if len(sys.argv) != 3:
        print("Usage: python script.py <image1_path> <image2_path>")
        sys.exit(1)

    # Get the paths of the fingerprint images from command-line arguments
    image1_path = sys.argv[1]
    image2_path = sys.argv[2]

    # Compare the fingerprint images and print the result
    result = compare_fingerprints(image1_path, image2_path)
    print(result)
    
